<?php

/**
 * KDDI au EZweb端末のリモートホスト正規表現とIPアドレス帯域 (2008/12/11 時点)
 *
 * @link http://www.au.kddi.com/ezfactory/tec/spec/ezsava_ip.html
 */

$host = '/^w[ab](\\d\\dproxy\\d\\d|cc\\d\\d?s\\d\\d?)\\.ezweb\\.ne\\.jp$/';

$band = array(
    '59.135.38.128/25',
    '61.117.0.128/25',
    '61.117.1.0/28',
    '61.117.1.128/25',
    '61.117.2.32/29',
    '61.117.2.40/29',
    '61.202.3.64/28',
    '118.152.214.192/26',
    '118.159.131.0/25',
    '118.159.133.0/25',
    '121.111.227.0/25',
    '121.111.227.160/27',
    '121.111.231.0/25',
    '121.111.231.160/27',
    '210.230.128.224/28',
    '218.222.1.0/25',
    '218.222.1.128/28',
    '218.222.1.144/28',
    '218.222.1.160/28',
    '219.108.157.0/25',
    '219.108.158.0/27',
    '219.108.158.40/29',
    '219.125.145.0/25',
    '219.125.146.0/28',
    '219.125.148.0/25',
    '219.125.148.160/27',
    '219.125.148.192/27',
    '219.125.151.128/27',
    '219.125.151.160/27',
    '219.125.151.192/27',
    '222.5.62.128/25',
    '222.5.63.0/25',
    '222.5.63.128/25',
    '222.7.56.0/27',
    '222.7.56.32/27',
    '222.7.56.96/27',
    '222.7.56.128/27',
    '222.7.56.192/27',
    '222.7.56.224/27',
    '222.7.57.32/27',
    '222.7.57.64/27',
    '222.7.57.96/27',
    '222.7.57.128/27',
    '222.7.57.160/27',
    '222.7.57.192/27',
    '222.7.57.224/27',
);

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
