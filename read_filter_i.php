<?php
/* vim: set fileencoding=cp932 ai et ts=4 sw=4 sts=0 fdm=marker: */
/* mi: charset=Shift_JIS */

// p2 - �g�єŃ��X�t�B���^�����O

require_once './conf/conf.inc.php';

require_once P2_LIB_DIR . '/P2Validate.php';


$_login->authorize(); // ���[�U�F��

// {{{ �X���b�h���

$host = geti($_GET['host']);
$bbs  = geti($_GET['bbs']);
$key  = geti($_GET['key']);
$ttitle = base64_decode(geti($_GET['ttitle_en']));
$ttitle_back_ht = isset($_SERVER['HTTP_REFERER'])
    ? '<a href="' . hs($_SERVER['HTTP_REFERER']) . '" title="�߂�">' . hs($ttitle) . '</a>'
    : hs($ttitle);

if (P2Validate::host($host) || P2Validate::bbs($bbs) || P2Validate::key($key)) {
    p2die('�s���Ȉ����ł�');
}

// }}}
// {{{ �O��t�B���^�l�ǂݍ���

require_once P2_LIB_DIR . '/FileCtl.php';

$cachefile = $_conf['pref_dir'] . '/p2_res_filter.txt';

$res_filter = array();
if (file_exists($cachefile) and $res_filter_cont = file_get_contents($cachefile)) {
    $res_filter = unserialize($res_filter_cont);
}

$field  = array('whole' => '', 'msg' => '', 'name' => '', 'mail' => '', 'date' => '', 'id' => '', 'beid' => '', 'belv' => '');
$match  = array('on' => '', 'off' => '');
$method = array('and' => '', 'or' => '', 'just' => '', 'regex' => '', 'similar' => '');

$field[$res_filter['field']]   = ' selected';
$match[$res_filter['match']]   = ' selected';
$method[$res_filter['method']] = ' selected';

// }}}

$hr = P2View::getHrHtmlK();
$body_at = P2View::getBodyAttrK();

// �����t�H�[���y�[�W HTML�\��

P2Util::headerNoCache();
P2View::printDoctypeTag();
?>
<html lang="ja">
<head>
<?php
P2View::printExtraHeadersHtml();
echo <<<EOF
    <link rel="stylesheet" type="text/css" href="./iui/read.css">
    <title>�X��������</title>
</head>
<body{$body_at}>
<div class="toolbar">
<h1>{$ttitle_back_ht}</h1>
<a id="backButton" class="button" href="iphone.php">TOP</a>
</div>


<form class="panel" id="header" method="get" action="{$_conf['read_php']}" accept-charset="{$_conf['accept_charset']}">
<h2>�������[�h</h2>
<filedset>
<input type="hidden" name="detect_hint" value="����">
<input type="hidden" name="host" value="{$host}">
<input type="hidden" name="bbs" value="{$bbs}">
<input type="hidden" name="key" value="{$key}">
<input type="hidden" name="ls" value="all">
<input type="hidden" name="offline" value="1">
<input class="serch" id="word" name="word">
<input class="whitebutton" type="submit" name="s1" value="����">
</filedset>
<br>
<h2>�����I�v�V����</h2>
<filedset>
<select class="serch" id="field" name="field">
 <option value="whole"{$field['whole']}>�S��</option>
 <option value="msg"{$field['msg']}>���b�Z�[�W</option>
 <option value="name"{$field['name']}>���O</option>
 <option value="mail"{$field['mail']}>���[��</option>
 <option value="date"{$field['date']}>���t</option>
 <option value="id"{$field['id']}>ID</option>
 <!-- <option value="belv"{$field['belv']}>�|�C���g</option> -->
</select>
��
<select class="serch" id="method" name="method">
 <option value="or"{$method['or']}>�����ꂩ</option>
 <option value="and"{$method['and']}>���ׂ�</option>
 <option value="just"{$method['just']}>���̂܂�</option>
 <option value="regex"{$method['regex']}>���K�\��</option>
</select>
��
<select class="serch" id="match" name="match">
 <option value="on"{$match['on']}>�܂�</option>
 <option value="off"{$match['off']}>�܂܂Ȃ�</option>
</select><br>
<input class="whitebutton" type="submit" name="s2" value="����">

{$_conf['k_input_ht']}
</form>

</filedset>
</div>
?>
</body>
</html>
<?php