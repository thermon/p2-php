<?php
// p2 - �X���b�h���ځ[�񕡐��ꊇ��������

require_once("datactl.inc");

//====================================================================
// �X���b�h���ځ[��𕡐��ꊇ��������֐�
//====================================================================
function settaborn_off($host, $bbs, $taborn_off_keys){
	
	//==============================================================
	// p2_threads_aborn.idx�ɏ�������
	//==============================================================
	
	// p2_threads_aborn.idx �̃p�X�擾
	$datdir_host = datdirOfHost($host);
	$taborn_idx = "{$datdir_host}/{$bbs}/p2_threads_aborn.idx";
	
	// p2_threads_aborn.idx ���Ȃ����
	if(! file_exists($taborn_idx) ){die("���ځ[�񃊃X�g��������܂���ł����B");}
	
	// p2_threads_aborn.idx �ǂݍ���
	$taborn_lines= @file($taborn_idx);
	
	//�w��key���폜 ===================================
	if($taborn_off_keys){
		
		foreach($taborn_off_keys as $val){
			$neolines="";
			
			if($taborn_lines){
				foreach($taborn_lines as $tal){
					$lar = explode("<>", $tal);
					if($lar[1]==$val){ //key����
						//echo "key:{$val} �̃X���b�h�����ځ[��������܂����B<br>";
						$kaijo_attayo=true;
						continue;
					}
					if(! $lar[1]){continue;} //key�̂Ȃ����͕̂s���f�[�^
					$neolines[]=$tal;
				}
			}
			
			$taborn_lines=$neolines;
		}
		
		//��������====================================================
		if(file_exists($taborn_idx)){
			copy($taborn_idx, $taborn_idx.'.bak'); //�O�̂��߃o�b�N�A�b�v
		}
		$fp = @fopen($taborn_idx,"w") or die("Error: $taborn_idx ���X�V�ł��܂���ł���");
		if($neolines){
			foreach($neolines as $l){ fputs($fp,"$l"); }
		}
		fclose($fp);
	
		/*
		if(! $kaijo_attayo){
			//echo "�w�肳�ꂽ�X���b�h�͊��ɂ��ځ[�񃊃X�g�ɍڂ��Ă��Ȃ��悤�ł��B";
		}else{
			//echo "���ځ[������A�������܂����B";
		}
		*/		
	
	}

}

?>