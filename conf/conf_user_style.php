<?php
/* vim: set fileencoding=cp932 autoindent noexpandtab ts=4 sw=4 sts=0 fdm=marker: */
/* mi: charset=Shift_JIS */

// p2 - �f�U�C���p �ݒ�t�@�C��

/*
�R�����g�`����() ���̓f�t�H���g�l
�ݒ�� P2_STYLE_DIR/*_css.php �ƘA��
*/

//======================================================================
// �f�U�C���J�X�^�}�C�Y
//======================================================================

$STYLE['a_underline_none'] = "2"; // ("2") �����N�ɉ������i����:0, ���Ȃ�:1, �X���^�C�g���ꗗ�������Ȃ�:2�j

// �t�H���g ======================================================

$STYLE['fontfamily'] = "�q���M�m�p�S Pro W3"; // ("�q���M�m�p�S Pro W3") ��{�̃t�H���g

if (strstr($_SERVER['HTTP_USER_AGENT'], "Mac")) {

	if (strstr($_SERVER['HTTP_USER_AGENT'], "AppleWebKit")) { /* �u���E�U�� Mac�� Safari���� WebKit���g���Ă�����̂Ȃ� */
		$STYLE['fontfamily'] = "Hiragino Kaku Gothic Pro"; // ("Hiragino Kaku Gothic Pro") ��{�̃t�H���g
		$STYLE['fontfamily_bold'] = ""; // ("") ��{�{�[���h�p�t�H���g
	} else {
		$STYLE['fontfamily_bold'] = "�q���M�m�p�S Pro W6"; // ("�q���M�m�p�S Pro W6") ��{�{�[���h�p�t�H���g�i���ʂɑ����ɂ������ꍇ�͎w�肵�Ȃ�("")�j
	}

	/* Mac�p�t�H���g�T�C�Y */
	$STYLE['fontsize'] = "12px"; // ("12px") ��{�t�H���g�̑傫��
	$STYLE['menu_fontsize'] = "11px"; // ("11px") ���j���[�̃t�H���g�̑傫��
	$STYLE['sb_fontsize'] = "11px"; // ("11px") �X���ꗗ�̃t�H���g�̑傫��
	$STYLE['read_fontsize'] = "12px"; // ("12px") �X���b�h���e�\���̃t�H���g�̑傫��
	$STYLE['respop_fontsize'] = "11px"; // ("11px") ���p���X�|�b�v�A�b�v�\���̃t�H���g�̑傫��
	$STYLE['infowin_fontsize'] = "11px"; // ("11px") ���E�B���h�E�̃t�H���g�̑傫��
	$STYLE['form_fontsize'] = "11px"; // ("11px") input, option, select �̃t�H���g�̑傫���iCamino�������j
} else {

	/* Mac�ȊO�̃t�H���g�T�C�Y */
	$STYLE['fontsize'] = "12px"; // ("12px") ��{�t�H���g�̑傫��
	$STYLE['menu_fontsize'] = "12px"; // ("12px") ���j���[�̃t�H���g�̑傫��
	$STYLE['sb_fontsize'] = "12px"; // ("12px") �X���ꗗ�̃t�H���g�̑傫��
	$STYLE['read_fontsize'] = "13px"; // ("13px") �X���b�h���e�\���̃t�H���g�̑傫��
	$STYLE['respop_fontsize'] = "12px"; // ("12px") ���p���X�|�b�v�A�b�v�\���̃t�H���g�̑傫��
	$STYLE['infowin_fontsize'] = "12px"; // ("12px") ���E�B���h�E�̃t�H���g�̑傫��
	$STYLE['form_fontsize'] = "12px"; // ("12px") input, option, select �̃t�H���g�̑傫��
}

//======================================================================
// �F�ʂ̐ݒ�
//======================================================================
// ���w��("")�̓u���E�U�̃f�t�H���g�F�A�܂��͊�{�w��ƂȂ�܂��B
// �D��x�́A�ʃy�[�W�w�� �� ��{�w�� �� �g�p�u���E�U�̃f�t�H���g�w�� �ł��B

// ��{(style) =======================
$STYLE['bgcolor'] = "#ffffff"; // ("#ffffff") ��{ �w�i�F
$STYLE['background'] = ""; // ("") ��{ �w�i�摜
$STYLE['textcolor'] = "#000"; // ("#000") ��{ �e�L�X�g�F
$STYLE['acolor'] = ""; // ("") ��{ �����N�F
$STYLE['acolor_v'] = ""; // ("") ��{ �K��ς݃����N�F�B
$STYLE['acolor_h'] = "#09c"; // ("#09c") ��{ �}�E�X�I�[�o�[���̃����N�F

$STYLE['fav_color'] = "#999"; // ("#999") ���C�Ƀ}�[�N�̐F

// ���j���[(menu) ====================
$STYLE['menu_bgcolor'] = "#fff"; //("#fff") menu �w�i�F
$STYLE['menu_background'] = ""; //("") ���j���[�̔w�i�摜
$STYLE['menu_color'] = "#000"; //("#000") menu �e�L�X�g�F
$STYLE['menu_cate_color'] = "#333"; // ("#333") menu �J�e�S���[�̐F

$STYLE['menu_acolor_h'] = "#09c"; // ("#09c") menu �}�E�X�I�[�o�[���̃����N�F

$STYLE['menu_ita_color'] = ""; // ("") menu �� �����N�F
$STYLE['menu_ita_color_v'] = ""; // ("") menu �� �K��ς݃����N�F
$STYLE['menu_ita_color_h'] = "#09c"; // ("#09c") menu �� �}�E�X�I�[�o�[���̃����N�F

$STYLE['menu_newthre_color'] = "hotpink";	// ("hotpink") menu �V�K�X���b�h���̐F
$STYLE['menu_newres_color'] = "#ff3300";	// ("#ff3300") menu �V�����X���̐F

// �X���ꗗ(subject) ====================
$STYLE['sb_bgcolor'] = "#fff"; // ("#fff") subject �w�i�F
$STYLE['sb_background'] = ""; // ("") subject �w�i�摜
$STYLE['sb_color'] = "#000";  // ("#000") subject �e�L�X�g�F

$STYLE['sb_acolor'] = "#000"; // ("#000") subject �����N�F
$STYLE['sb_acolor_v'] = "#000"; // ("#000") subject �K��ς݃����N�F
$STYLE['sb_acolor_h'] = "#09c"; // ("#09c") subject �}�E�X�I�[�o�[���̃����N�F

$STYLE['sb_th_bgcolor'] = "#d6e7ff"; // ("#d6e7ff") subject �e�[�u���w�b�_�w�i�F
$STYLE['sb_th_background'] = ""; // ("") subject �e�[�u���w�b�_�w�i�摜
$STYLE['sb_tbgcolor'] = "#fff"; // ("#fff") subject �e�[�u�����w�i�F0
$STYLE['sb_tbgcolor1'] = "#eef"; // ("#eef") subject �e�[�u�����w�i�F1
$STYLE['sb_tbackground'] = ""; // ("") subject �e�[�u�����w�i�摜0
$STYLE['sb_tbackground1'] = ""; // ("") subject �e�[�u�����w�i�摜1

$STYLE['sb_ttcolor'] = "#333"; // ("#333") subject �e�[�u���� �e�L�X�g�F
$STYLE['sb_tacolor'] = "#000"; // ("#000") subject �e�[�u���� �����N�F
$STYLE['sb_tacolor_h'] = "#09c"; // ("#09c")subject �e�[�u���� �}�E�X�I�[�o�[���̃����N�F

$STYLE['sb_order_color'] = "#111"; // ("#111") �X���ꗗ�̔ԍ� �����N�F

$STYLE['thre_title_color'] = "#000"; // ("#000") subject �X���^�C�g�� �����N�F
$STYLE['thre_title_color_v'] = "#999"; // ("#999") subject �X���^�C�g�� �K��ς݃����N�F
$STYLE['thre_title_color_h'] = "#09c"; // ("#09c") subject �X���^�C�g�� �}�E�X�I�[�o�[���̃����N�F

$STYLE['sb_tool_bgcolor'] = "#8cb5ff"; // ("#8cb5ff") subject �c�[���o�[�̔w�i�F
$STYLE['sb_tool_background'] = ""; // ("") subject �c�[���o�[�̔w�i�摜
$STYLE['sb_tool_border_color'] = "#6393ef"; // ("#6393ef") subject �c�[���o�[�̃{�[�_�[�F
$STYLE['sb_tool_color'] = "#d6e7ff"; // ("#d6e7ff") subject �c�[���o�[�� �����F
$STYLE['sb_tool_acolor'] = "#d6e7ff"; // ("#d6e7ff") subject �c�[���o�[�� �����N�F
$STYLE['sb_tool_acolor_v'] = "#d6e7ff"; // ("#d6e7ff") subject �c�[���o�[�� �K��ς݃����N�F
$STYLE['sb_tool_acolor_h'] = "#fff"; // ("#fff") subject �c�[���o�[�� �}�E�X�I�[�o�[���̃����N�F
$STYLE['sb_tool_sepa_color'] = "#000"; // ("#000") subject �c�[���o�[�� �Z�p���[�^�����F

$STYLE['sb_now_sort_color'] = "#1144aa";	// ("#1144aa") subject ���݂̃\�[�g�F

$STYLE['sb_thre_title_new_color'] = "red";	// ("red") subject �V�K�X���^�C�g���̐F

$STYLE['sb_tool_newres_color'] = "#ff3300"; // ("#ff3300") subject �c�[���o�[�� �V�K���X���̐F
$STYLE['sb_newres_color'] = "#ff3300"; // ("#ff3300") subject �V�����X���̐F


// �X�����e(read) ====================
$STYLE['read_bgcolor'] = "#efefef"; // ("#efefef") �X���b�h�\���̔w�i�F
$STYLE['read_background'] = ""; // ("") �X���b�h�\���̔w�i�摜
$STYLE['read_color'] = "#000"; // ("#000") �X���b�h�\���̃e�L�X�g�F

$STYLE['read_acolor'] = ""; // ("") �X���b�h�\�� �����N�F
$STYLE['read_acolor_v'] = ""; // ("") �X���b�h�\�� �K��ς݃����N�F
$STYLE['read_acolor_h'] = "#09c"; // ("#09c") �X���b�h�\�� �}�E�X�I�[�o�[���̃����N�F

$STYLE['read_newres_color'] = "#ff3300"; // ("#ff3300")  �V�����X�Ԃ̐F

$STYLE['read_thread_title_color'] = "#f40"; // ("#f40") �X���b�h�^�C�g���F
$STYLE['read_name_color'] = "#1144aa"; // ("#1144aa") ���e�҂̖��O�̐F
$STYLE['read_mail_color'] = ""; // ("") ���e�҂�mail�̐F ex)"#a00000"
$STYLE['read_mail_sage_color'] = ""; // ("") sage�̎��̓��e�҂�mail�̐F ex)"#00b000"
$STYLE['read_ngword'] = "#bbbbbb"; // ("#bbbbbb") NG���[�h�̐F

// �������[�h ================
$SYTLE['live_border_width'] = "1px"; // ("1px") // �{�[�_�[��
$SYTLE['live_border_color'] = "#888"; // ("#888") // �{�[�_�[�F
$SYTLE['live_border_style'] = "solid"; // ("solid") // �{�[�_�[�`��

// ���X�������݃t�H�[�� ================
$STYLE['post_pop_size'] = "610,350"; // ("610,350") ���X�������݃|�b�v�A�b�v�E�B���h�E�̑傫���i��,�c�j
$STYLE['post_msg_rows'] = 10; // (10) ���X�������݃t�H�[���A���b�Z�[�W�t�B�[���h�̍s��
$STYLE['post_msg_cols'] = 70; // (70) ���X�������݃t�H�[���A���b�Z�[�W�t�B�[���h�̌���

// ���X�|�b�v�A�b�v ====================
$STYLE['respop_color'] = "#000"; // ("#000") ���X�|�b�v�A�b�v�̃e�L�X�g�F
$STYLE['respop_bgcolor'] = "#ffffcc"; // ("#ffffcc") ���X�|�b�v�A�b�v�̔w�i�F
$STYLE['respop_background'] = ""; // ("") ���X�|�b�v�A�b�v�̔w�i�摜
$STYLE['respop_b_width'] = "1px"; // ("1px") ���X�|�b�v�A�b�v�̃{�[�_�[��
$STYLE['respop_b_color'] = "black"; // ("black") ���X�|�b�v�A�b�v�̃{�[�_�[�F
$STYLE['respop_b_style'] = "solid"; // ("solid") ���X�|�b�v�A�b�v�̃{�[�_�[�`��

$STYLE['info_pop_size'] = "600,380"; // ("600,380") ���|�b�v�A�b�v�E�B���h�E�̑傫���i��,�c�j
?>