<?php
// p2 ���O�C��

//=========================================================
// �֐�
//=========================================================

//====================================================
// �g�їp�[��ID�̔F�ؓo�^���Z�b�g����֐�
//====================================================
function regist_set_ktai($auth_ez_file, $auth_jp_file){
	global $_info_msg_ht;

	if( isset($_GET['regist_ez']) ){ $regist_ez = $_GET['regist_ez']; }
	if( isset($_POST['regist_ez']) ){ $regist_ez = $_POST['regist_ez']; }
	if( isset($_GET['regist_jp']) ){ $regist_jp = $_GET['regist_jp']; }
	if( isset($_POST['regist_jp']) ){ $regist_jp = $_POST['regist_jp']; }
	
	// �F�ؓo�^���� EZweb=================================
	if( isset($regist_ez) ){
		if($_SERVER['HTTP_X_UP_SUBNO']){
			if($regist_ez=="in"){
				regist_auth( "registed_ez", $_SERVER['HTTP_X_UP_SUBNO'], $auth_ez_file );
			}elseif($regist_ez=="out"){
				regist_auth_off($auth_ez_file);
			}
		}else{
			$_info_msg_ht .= "<p class=\"infomsg\">�~EZweb�p�ŗLID�̔F�ؓo�^�͂ł��܂���ł���</p>\n";
		}
	
	// �F�ؓo�^���� J-PHONE===============================
	}elseif( isset($regist_jp) ){
		if( preg_match("/J-PHONE\/[^\/]+\/[^\/]+\/SN(.+?) /", $_SERVER['HTTP_USER_AGENT'], $matches) ){
			if($regist_jp=="in"){
				regist_auth( "registed_jp", $matches[1], $auth_jp_file );
			}elseif($regist_jp=="out"){
				regist_auth_off($auth_jp_file);
			}
		}else{
			$_info_msg_ht .= "<p class=\"infomsg\">�~J-PHONE�p�ŗLID�̔F�ؓo�^�͂ł��܂���ł���</p>\n";
		}
	
	}

}

//=====================================================
// cookie�F�ؓo�^���Z�b�g����֐�
//=====================================================
function regist_set_cookie(){
	global $_info_msg_ht;

	if( isset($_GET['regist_cookie']) ){ $regist_cookie = $_GET['regist_cookie']; }
	if( isset($_POST['regist_cookie']) ){ $regist_cookie = $_POST['regist_cookie']; }

	if( isset($regist_cookie) ){
		if($regist_cookie=="in"){
			setcookie('p2_user', $_POST['login_user'], time()+60*60*24*1000);
			setcookie('p2_pass', $_POST['login_pass'], time()+60*60*24*1000);//
			//$check_msg_st="cookie�F�ؓo�^...";
		}elseif($regist_cookie=="out"){
			setcookie ("p2_user", "", time() - 3600);
			setcookie ("p2_pass", "", time() - 3600);
			//$check_msg_st="cookie�F�؉���...";
		}
	}

}

//====================================================
// �[��ID��F�؃t�@�C���o�^����֐�
//====================================================
function regist_auth($keyw, $sub_id, $auth_file){
	global $_info_msg_ht, $pass_perm, $p2error_st;
	$cont=<<<EOP
<?php
\${$keyw}='{$sub_id}';
?>
EOP;
	FileCtl::make_datafile($auth_file, $pass_perm);
	$fp = @fopen($auth_file,"w");
	if(!$fp){
		$_info_msg_ht .= "<p>{$p2error_st}: {$auth_file} ��ۑ��ł��܂���ł����B�F�ؓo�^���s�B</p>";
		return false;
	}
	fwrite($fp,$cont);
	fclose($fp);
	return true;
}

//====================================================
// �[��ID�̔F�؃t�@�C���o�^���O���֐�
//====================================================
function regist_auth_off($auth_file){
	if( file_exists($auth_file) ){
		unlink($auth_file);
	}
	return;
}

//====================================================
// �����񂪉p�������ǂ������`�F�b�N����֐�
//====================================================
function isStrInvalid($strings){
	$length=strlen($strings);
	while($length){
		$h=substr($strings, 0, 1);
		if(! preg_match("/[0-9a-zA-Z_]/", $h)){
			return true;
		}
		$strings=substr($strings, 1, $length);
		$length--;
	}
	return false;
}

?>