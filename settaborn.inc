<?php
// p2 - �X���b�h���ځ[��̊֐�

require_once("./filectl_class.inc");
require_once("./datactl.inc");

//====================================================================
// settaborn - �X���b�h���ځ[����I���I�t����֐�
// $set �́A0(����), 1(�ǉ�), 2(�g�O��)
//====================================================================
function settaborn($host, $bbs, $key, $set){
	global $title_msg, $info_msg, $p2_perm;
	
	//==================================================================
	// key.idx �ǂݍ���
	//==================================================================
	
	//idxfile�̃p�X�����߂�
	$datdir_host=datdirOfHost($host);
	$idxfile="{$datdir_host}/{$bbs}/{$key}.idx";
	
	//�f�[�^������Ȃ�ǂݍ���
	if( is_readable($idxfile) ){
		$lines=@file($idxfile);
		$data = explode("<>", $lines[0]);
	}
	
	//==================================================================
	// p2_threads_aborn.idx�ɏ�������
	//==================================================================
	
	// p2_threads_aborn.idx �̃p�X�擾
	$datdir_host = datdirOfHost($host);
	$taborn_idx = "{$datdir_host}/{$bbs}/p2_threads_aborn.idx";
	
	// p2_threads_aborn.idx ���Ȃ���ΐ���
	FileCtl::make_datafile($taborn_idx, $p2_perm);
	
	// p2_threads_aborn.idx �ǂݍ���;
	$taborn_lines= @file($taborn_idx);
	
	//�ŏ��ɏd���v�f���폜
	if($taborn_lines){
		foreach($taborn_lines as $tal){
			$lar = explode("<>", $tal);
			if($lar[1]==$key){
				$aborn_attayo=true; //���ɂ��ځ[�񒆂ł���
				if($set==0 or $set==2){
					$title_msg_pre="+ ���ځ[�� �������܂���";
					$info_msg_pre="+ ���ځ[�� �������܂���";
				}
				continue;
			} //�d�����
			if(! $lar[1]){continue;} //key�̂Ȃ����͕̂s���f�[�^
			$neolines[]=$tal;
		}
	}
	
	//�V�K�f�[�^�ǉ�
	if($set==1 or !$aborn_attayo && $set==2){
		$newdata="$data[0]<>{$key}<><><><><><><><>\n";
		$neolines ? array_unshift($neolines, $newdata) : $neolines=array($newdata);
		$title_msg_pre="�� ���ځ[�� ���܂���";
		$info_msg_pre="�� ���ځ[�� ���܂���";
	}
	
	//��������
	$fp = @fopen($taborn_idx,"w") or die("Error: $taborn_idx ���X�V�ł��܂���ł���");
	if($neolines){
		foreach($neolines as $l){ fputs($fp,"$l"); }
	}
	fclose($fp);
	
	$title_msg=$title_msg_pre;
	$info_msg=$info_msg_pre;
	return true;
}

?>