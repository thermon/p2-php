<?php
// p2 �[�X�^�C���ݒ�
// �S��

if ($STYLE['a_underline_none'] == 1) {
	$a_underline_none_css = "a{text-decoration:none;}";
}

echo <<<EOP
<style type="text/css" media="all">
<!--
EOP;

// �u���E�U�� Camino �Ȃ�
if (strstr($_SERVER['HTTP_USER_AGENT'], "Camino") || strstr($_SERVER['HTTP_USER_AGENT'], "Chimera")) {
	echo <<<EOP
	input,option,select{
		font-size:10px;
		font-family:"Osaka"; /*  Camino �ł̓t�H�[���̃t�H���g�Ƀq���M�m���w�肷���line-height������� */
	}
EOP;
} else {
	echo <<<EOP
	input,option,select{
		font-size:{$STYLE['form_fontsize']};
	}
EOP;
}

if($STYLE['fontfamily_bold']){
	echo <<<EOP
	b{font-weight:normal; font-family:"{$STYLE['fontfamily_bold']}";}
EOP;
}

echo <<<EOP

	body{
		background:{$STYLE['bgcolor']};
	}
	body,td{
		line-height:135%;
		font-size:{$STYLE['fontsize']};
		color:{$STYLE['textcolor']};
		font-family:"{$STYLE['fontfamily']}";
	}
	a:link{color:{$STYLE['acolor']};}
	a:visited{color:{$STYLE['acolor_v']};}
	a:hover{color:{$STYLE['acolor_h']};}
	{$a_underline_none_css}
	
	a:link.fav{color:{$STYLE['fav_color']};} /* ���C�Ƀ}�[�N */
	a:visited.fav{color:{$STYLE['fav_color']};}
	a:hover.fav{color:{$STYLE['acolor_h']};}
	
	img, object{border:none;}
	
	hr{height:1px; color:#ccc;}
	
	div.container{
		width:76%;
		margin:8px auto;
		padding:0px 16px;
		text-align:left;
	}

	.invisible{visibility: hidden;}
	
	.kakomi{
		padding: 16px;
		border:solid 1px #999;
	}
	
	.filtering{background-color:yellow;} /* �t�B���^�̃��[�h�F���� */
	
	form.inline-form {
		display: inline;
	}

-->
</style>\n
EOP;
?>