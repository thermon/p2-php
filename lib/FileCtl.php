<?php
// {{{ constants
/*
if (!defined('FILE_USE_INCLUDE_PATH')) {
    define('FILE_USE_INCLUDE_PATH', 1);
}

if (!defined('FILE_APPEND')) {
    define('FILE_APPEND', 8);
}
*/

if (in_array('compress.zlib', stream_get_wrappers())) {
    define('FILECTL_HAVE_COMPRESS_ZLIB_WRAPPER', 1);
} else {
    define('FILECTL_HAVE_COMPRESS_ZLIB_WRAPPER', 0);
}

// }}}
// {{{ FileCtl

/**
 * ファイルを操作するクラス
 * インスタンスを作らずにクラスメソッドで利用する
 *
 * @static
 */
class FileCtl
{
    // {{{ make_datafile()

    /**
     * 書き込み用のファイルがなければ生成してパーミッションを調整する
     *
     * @param string $file
     * @param int $perm
     * @return bool
     */
    static public function make_datafile($file, $perm = null)
    {
        global $_conf;

        // デフォルトのパーミッション
        if ($perm === null || !($perm & 0777)) {
            $default_perm = 0777 & $_conf['p2_perm'];
            $perm = $default_perm ? $default_perm : 0606;
        }

        if (strpos($file, P2_NULLBYTE) !== false) {
            $epath = str_replace(P2_NULLBYTE, '\\0', $file);
            p2die("cannot make datafile. ({$epath})", 'ファイル名にNULLバイトが含まれています。');
        }

        if (!file_exists($file)) {
            // 親ディレクトリが無ければ作る
            self::mkdir_for($file) or p2die("cannot make parent dirs. ({$file})");
            touch($file) or p2die("cannot touch. ({$file})");
            chmod($file, $perm);
        } else {
            if (!is_writable($file)) {
                $cont = self::file_read_contents($file);
                unlink($file);
                if (self::file_write_contents($file, $cont) === false) {
                    p2die('cannot write file.');
                }
                chmod($file, $perm);
            }
        }
        return true;
    }

    // }}}
    // {{{ mkdir_for()

    /**
     * 親ディレクトリがなければ生成してパーミッションを調整する
     *
     * @param string $apath
     * @param int $perm
     * @return bool
     */
    static public function mkdir_for($apath, $perm = null)
    {
        global $_conf;

        // デフォルトのパーミッション
        if ($perm === null || !($perm & 0777)) {
            $default_perm = 0777 & $_conf['data_dir_perm'];
            $perm = $default_perm ? $default_perm : 0707;
        }

        $dir_limit = 50; // 親階層を上る制限回数

        if (!$parentdir = dirname($apath)) {
            p2die("cannot mkdir. ({$parentdir})", '親ディレクトリが空白です。');
        }
        if (strpos($parentdir, P2_NULLBYTE) !== false) {
            $epath = str_replace(P2_NULLBYTE, '\\0', $parentdir);
            p2die("cannot mkdir. ({$epath})", 'ディレクトリ名にNULLバイトが含まれています。');
        }
        $i = 1;
        if (!is_dir($parentdir)) {
            if ($i > $dir_limit) {
                p2die("cannot mkdir. ({$parentdir})", '階層を上がり過ぎたので、ストップしました。');
            }
            self::mkdir_for($parentdir);
            mkdir($parentdir, $perm) or p2die("cannot mkdir. ({$parentdir})");
            chmod($parentdir, $perm);
            $i++;
        }
        return true;
    }

    // }}}
    // {{{ get_gzfile_contents()

    /**
     * gzファイルの中身を取得する
     */
    static public function get_gzfile_contents($filepath)
    {
        if (is_readable($filepath)) {
            if (FILECTL_HAVE_COMPRESS_ZLIB_WRAPPER) {
                return file_get_contents('compress.zlib://' . realpath($filepath));
            }
            ob_start();
            readgzfile($filepath);
            return ob_get_clean();
        } else {
            return false;
        }
    }

    // }}}
    // {{{ file_write_contents()

    /**
     * 文字列をファイルに書き込む
     * （file_put_contents()+強制LOCK_EX）
     *
     * @param string $filename
     * @param mixed $data
     * @param int $flags
     * @param resource $context
     */
    static public function file_write_contents($filename,
                                               $data,
                                               $flags = 0,
                                               $context = null
                                               )
    {
        return file_put_contents($filename, $data, $flags | LOCK_EX, $context);
    }

    // }}}
    // {{{ file_read_contents()

    /**
     * ファイルから文字列を読み込む
     * エラー抑制付きの @file_get_contents() の代用
     *
     * マクロPHP_STREAM_COPY_ALLに対応する定数がない (size_tは
     * 一般的に符号なし、PHP_INT_MAXより大きい) ので、-1で判定する
     *
     * @param string $filename
     * @param int $flags
     * @param resource $context
     * @param int $offset
     * @param int $maxlen
     */
    static public function file_read_contents($filename,
                                              $flags = 0,
                                              $context = null,
                                              $offset = -1,
                                              $maxlen = -1
                                              )
    {
        if (!is_readable($filename)) {
            return false;
        }
        if ($maxlen < 0) {
            if ($offset < 0) {
                return file_get_contents($filename, $flags, $context);
            }
            return file_get_contents($filename, $flags, $context, $offset);
        }
        return file_get_contents($filename, $flags, $context, $offset, $maxlen);
    }

    // }}}
    // {{{ gzfile_read_contents()

    /**
     * gzip圧縮されたファイルから文字列を読み込む
     * FileCtl::file_read_contents() の相方
     *
     * @param string $filename
     * @param int $flags
     * @param resource $context
     * @param int $offset
     * @param int $maxlen
     */
    static public function gzfile_read_contents($filename,
                                                $flags = 0,
                                                $context = null,
                                                $offset = -1,
                                                $maxlen = -1
                                                )
    {
        if (!is_readable($filename)) {
            return false;
        }

        // {{{ compress.zlib ストリームラッパーあり

        if (FILECTL_HAVE_COMPRESS_ZLIB_WRAPPER) {
            $filename = 'compress.zlib://' . realpath($filename);
            if ($maxlen < 0) {
                if ($offset < 0) {
                    return file_get_contents($filename, $flags, $context);
                }
                return file_get_contents($filename, $flags, $context, $offset);
            }
            return file_get_contents($filename, $flags, $context, $offset, $maxlen);
        }

        // }}}
        // {{{ gzopen() を使って

        if ($context !== null) {
            trigger_error('FileCtl::gzfile_read_contents(): context is not supported', E_USER_WARNING);
            return false;
        }

        $fp = gzopen($filename, 'rb', $flags & FILE_USE_INCLUDE_PATH);
        if (!$fp) {
            return false;
        }
        flock($fp, LOCK_SH);

        if ($offset > 0) {
            if (fseek($fp, $offset) == -1) {
                flock($fp, LOCK_UN);
                fclose($fp);
                return false;
            }
        }

        $content = '';

        if ($maxlen >= 0) {
            while (!feof($fp) && ($len = strlen($content)) < $maxlen) {
                if (($read = fread($fp, $maxlen - $len)) === false) {
                    $content = false;
                    break;
                }
                $content .= $read;
            }
        } else {
            while (!feof($fp)) {
                if (($read = fread($fp, 65536)) === false) {
                    $content = false;
                    break;
                }
                $content .= $read;
            }
        }

        flock($fp, LOCK_UN);
        fclose($fp);

        return $content;

        // }}}
    }

    // }}}
    // {{{ file_read_lines()

    /**
     * ファイル全体を読み込んで配列に格納する
     * エラー抑制付きの @file() の代用
     *
     * @param string $filename
     * @param int $flags
     * @param resource $context
     */
    static public function file_read_lines($filename, $flags = 0, $context = null)
    {
        if (!is_readable($filename)) {
            return false;
        }
        $lines = file($filename, $flags, $context);
        if (($flags & FILE_IGNORE_NEW_LINES) && $lines &&
            strlen($lines[0]) && substr($lines[0], -1) == "\r")
        {
            $lines = array_map(create_function('$l', 'return rtrim($l, "\\r");'), $lines);
            if ($flags & FILE_SKIP_EMPTY_LINES) {
                $lines = array_filter($lines, 'strlen');
            }
        }
        return $lines;
    }

    // }}}
    // {{{ gzfile_read_lines()

    /**
     * gzip圧縮されたファイル全体を読み込んで配列に格納する
     * エラー抑制付きの @gzfile() の代用
     *
     * $flags として FILE_IGNORE_NEW_LINES, FILE_IGNORE_NEW_LINES,
     * FILE_SKIP_EMPTY_LINES をサポートするので gzfile() より便利。
     *
     * @param string $filename
     * @param int $flags
     * @param resource $context
     */
    static public function gzfile_read_lines($filename, $flags = 0, $context = null)
    {
        if (!is_readable($filename)) {
            return false;
        }

        // {{{ compress.zlib ストリームラッパーあり

        if (FILECTL_HAVE_COMPRESS_ZLIB_WRAPPER) {
            return file('compress.zlib://' . realpath($filename), $flags, $context);
        }

        // }}}
        // {{{ gzopen() を使って

        if ($context !== null) {
            trigger_error('FileCtl::gzfile_read_lines(): context is not supported', E_USER_WARNING);
            return false;
        }

        $lines = array();

        $ignore_new_lines = (($flags & FILE_IGNORE_NEW_LINES) != 0);
        $skip_empty_lines = (($flags & FILE_SKIP_EMPTY_LINES) != 0);

        $fp = gzopen($filename, 'rb', $flags & FILE_USE_INCLUDE_PATH);
        if (!$fp) {
            return false;
        }
        flock($fp, LOCK_SH);

        while (!feof($fp)) {
            $line = fgets($fp);
            if ($ignore_new_lines) {
                $line = rtrim($line, "\r\n");
            }
            if ($skip_empty_lines && strlen($line) == 0) {
                continue;
            }
            $lines[] = $line;
        }

        flock($fp, LOCK_UN);
        fclose($fp);

        return $lines;

        // }}}
    }

    // }}}
}

// }}}
// {{{ P2Lock

/**
 * 簡易ロッククラス
 */
class P2Lock
{
    // {{{ properties

    /**
     * ロックファイルのパス
     *
     * @var string
     */
    private $_filename;

    /**
     * ロックファイルのハンドル
     *
     * @var resource
     */
    private $_fh;

    /**
     * ロックファイルを自動で削除するかどうか
     *
     * @var bool
     */
    private $_remove;

    // }}}
    // {{{ constructor

    /**
     * コンストラクタ
     *
     * @param  string $name     ロック名（≒排他処理したいファイル名）
     * @param  bool   $remove   ロックファイルを自動で削除するかどうか
     * @param  string $suffix   ロックファイル名の接尾辞
     */
    public function __construct($name, $remove = true, $suffix = '.lck')
    {
        $this->_filename = p2_realpath($name . $suffix);
        $this->_remove = $remove;

        FileCtl::mkdir_for($this->_filename);

        $this->_fh = fopen($this->_filename, 'wb');
        if (!$this->_fh) {
            p2die("cannot create lockfile ({$this->_filename}).");
        }
        if (!flock($this->_fh, LOCK_EX)) {
            p2die("cannot get lock ({$this->_filename}).");
        }
    }

    // }}}
    // {{{ destructor

    /**
     * デストラクタ
     */
    public function __destruct()
    {
        if (is_resource($this->_fh)) {
            flock($this->_fh, LOCK_UN);
            fclose($this->_fh);
            $this->_fh = null;
        }

        if ($this->_remove && file_exists($this->_filename)) {
            unlink($this->_filename);
        }
    }

    // }}}
    // {{{ free()

    /**
     * 明示的にロックを開放する
     */
    public function free()
    {
        $this->__destruct();
    }

    // }}}
    // {{{ remove()

    /**
     * 明示的にロックを開放し、ロックファイルを強制削除する
     *
     * unlink()はstat()のキャッシュを自動的にクリアするので
     * clearstatcache()する必要はない
     */
    public function remove()
    {
        $this->__destruct();
        if (file_exists($this->_filename)) {
            unlink($this->_filename);
        }
    }

    // }}}
}

// }}}

/*
 * Local Variables:
 * mode: php
 * coding: cp932
 * tab-width: 4
 * c-basic-offset: 4
 * indent-tabs-mode: nil
 * End:
 */
// vim: set syn=php fenc=cp932 ai et ts=4 sw=4 sts=4 fdm=marker:
