/* p2 - ���p���X�Ԃ��|�b�v�A�b�v���邽�߂�JavaScript */

/*
document.open;
document.writeln('<style type="text/css" media="all">');
document.writeln('<!--');
document.writeln('.respopup{visibility: hidden;}');
document.writeln('-->');
document.writeln('</style>');
document.close;
*/

delayShowSec = 0.1 * 1000;	// ���X�|�b�v�A�b�v��\������x�����ԁB
delaySec = 0.3 * 1000;	// ���X�|�b�v�A�b�v���\���ɂ���x�����ԁB
zNum = 0;

//==============================================================
// gPOPS -- ResPopUp �I�u�W�F�N�g���i�[����z��B
// �z�� gPOPS �̗v�f�����A���ݐ����Ă��� ResPopUp �I�u�W�F�N�g�̐��ƂȂ�B
//==============================================================
gPOPS = new Array(); 

gResPopCtl = new ResPopCtl();

gShowTimerIds = new Object();

/**
 * ���X�|�b�v�A�b�v��\���^�C�}�[����
 *
 * ���p���X�Ԃ� onMouseover �ŌĂяo�����
 */
function showResPopUp(divID, ev) {
	if (divID.indexOf("-") != -1) { return; } // �A�� (>>1-100) �͔�Ή��Ȃ̂Ŕ�����

	var aResPopUp = gResPopCtl.getResPopUp(divID);
	if (aResPopUp) {
		if (aResPopUp.hideTimerID) { clearTimeout(aResPopUp.hideTimerID); } // ��\���^�C�}�[������
	} else {
		// doShowResPopUp(divID, ev);

		if (document.all) { // IE�p
			var body = (document.compatMode=='CSS1Compat') ? document.documentElement : document.body;
			x = body.scrollLeft + event.clientX; // ���݂̃}�E�X�ʒu��X���W
			y = body.scrollTop + event.clientY; // ���݂̃}�E�X�ʒu��Y���W
		} else if (document.getElementById) { // DOM�Ή��p�iMozilla�j
			x = ev.pageX; // ���݂̃}�E�X�ʒu��X���W
			y = ev.pageY; // ���݂̃}�E�X�ʒu��Y���W
		} else {
			return;
		}
		
		aShowTimer = new Object();
		aShowTimer.timerID = setTimeout("doShowResPopUp('" + divID + "')", delayShowSec); // ��莞�Ԃ�����\������
		
		aShowTimer.x = x;
		aShowTimer.y = y;
		
		gShowTimerIds[divID] = aShowTimer;
		//alert(gShowTimerIds[divID].timerID);
	}
	
}

/**
 * ���X�|�b�v�A�b�v��\������
 */
function doShowResPopUp(divID) {

	x = gShowTimerIds[divID].x;
	y = gShowTimerIds[divID].y;
	
	var aResPopUp = gResPopCtl.getResPopUp(divID);
	if (aResPopUp) {
		if (aResPopUp.hideTimerID) { clearTimeout(aResPopUp.hideTimerID); } // ��\���^�C�}�[������
		
		/*
		// �ĕ\������ zIndex ���� ------------------------
		// �������Ȃ������Ғʂ�̓�������Ă���Ȃ��B
		// IE��Mozilla�ŋ������Ⴄ�B����Ĕ�A�N�e�B�u�B
		aResPopUp.zNum = zNum;
		aResPopUp.popOBJ.style.zIndex = aResPopUp.zNum;
		//----------------------------------------
		*/
		
	} else {
		zNum++;
		aResPopUp = gResPopCtl.addResPopUp(divID); // �V�����|�b�v�A�b�v��ǉ�
	}
	
	aResPopUp.showResPopUp(x, y);
}

/**
 * ���X�|�b�v�A�b�v���\���^�C�}�[����
 *
 * ���p���X�Ԃ��� onMouseout �ŌĂяo�����
 */
function hideResPopUp(divID) {
	if (divID.indexOf("-") != -1) { return; } // �A�� (>>1-100) �͔�Ή��Ȃ̂Ŕ�����
	
	if (gShowTimerIds[divID].timerID) { clearTimeout(gShowTimerIds[divID].timerID); } // �\���^�C�}�[������
	
	var aResPopUp = gResPopCtl.getResPopUp(divID);
	if (aResPopUp) {
		aResPopUp.hideResPopUp();
	}
}

/**
 * ���X�|�b�v�A�b�v���\���ɂ���
 */
function doHideResPopUp(divID) {
	var aResPopUp = gResPopCtl.getResPopUp(divID);
	if (aResPopUp) {
		aResPopUp.doHideResPopUp();
	}
}


/**
 * �I�u�W�F�N�g�f�[�^���R���g���[������N���X
 */
function ResPopCtl() {

	/**
	 * �z�� gPOPS �ɐV�K ResPopUp �I�u�W�F�N�g ��ǉ�����
	 */
	ResPopCtl.prototype.addResPopUp = function (divID) {
		var aResPopUp = new ResPopUp(divID);
		// gPOPS.push(aResPopUp); Array.push ��IE5.5�������Ή��Ȃ̂ő�֏���
		return gPOPS[gPOPS.length] = aResPopUp;
	}
	
	/**
	 * �z�� gPOPS ���� �w��� ResPopUp �I�u�W�F�N�g ���폜����
	 */
	ResPopCtl.prototype.rmResPopUp = function (divID) {
		for (i = 0; i < gPOPS.length; i++) {
	    	if (gPOPS[i].divID == divID) {

				gPOPS = arraySplice(gPOPS, i);
			
				return true;
			}
		}
		return false;
	}

	/**
	 * �z�� gPOPS �Ŏw�� divID �� ResPopUp �I�u�W�F�N�g��Ԃ�
	 */
	ResPopCtl.prototype.getResPopUp = function (divID) {
		for (i = 0; i < gPOPS.length; i++) {
	    	if (gPOPS[i].divID == divID) {
				return gPOPS[i];
			}
		}
		return false;
	}
	
	return this;
}

/**
 * arraySplice
 *
 * anArray.splice(i, 1); Array.splice ��IE5.5�������Ή��Ȃ̂ő�֏���
 * @return array
 */
function arraySplice(anArray, i) {
	var newArray = new Array();
	for (j = 0; j < anArray.length; j++) {
		if (j != i) {
			newArray[newArray.length] = anArray[j];
		}
	}
	return newArray;
}

/**
 * ���X�|�b�v�A�b�v�N���X
 */
function ResPopUp(divID) {
	
    this.divID = divID;
	this.zNum = zNum;
	this.hideTimerID = 0;
	
	if (document.all) { // IE�p
		this.popOBJ = document.all[this.divID];
	} else if (document.getElementById) { // DOM�Ή��p�iMozilla�j
		this.popOBJ = document.getElementById(this.divID);
	}
	
	/**
	 * ���X�|�b�v�A�b�v��\������
	 */
	ResPopUp.prototype.showResPopUp = function (x, y) {
		var x_adjust = 10;	// x���ʒu����
		var y_adjust = -68;	// y���ʒu����
		if (this.popOBJ.style.visibility != "visible") {
			this.popOBJ.style.zIndex = this.zNum;
			if (document.all) { // IE�p
				var body = (document.compatMode=='CSS1Compat') ? document.documentElement : document.body;
				//x = body.scrollLeft + event.clientX; // ���݂̃}�E�X�ʒu��X���W
				//y = body.scrollTop + event.clientY; // ���݂̃}�E�X�ʒu��Y���W
				this.popOBJ.style.pixelLeft  = x + x_adjust; //�|�b�v�A�b�v�ʒu
				this.popOBJ.style.pixelTop  = y + y_adjust;
				
				if( (this.popOBJ.offsetTop + this.popOBJ.offsetHeight) > (body.scrollTop + body.clientHeight) ){
					this.popOBJ.style.pixelTop = body.scrollTop + body.clientHeight - this.popOBJ.offsetHeight -20;
				}
				if (this.popOBJ.offsetTop < body.scrollTop) {
					this.popOBJ.style.pixelTop = body.scrollTop -2;
				}
				
			} else if (document.getElementById) { // DOM�Ή��p�iMozilla�j
				//x = ev.pageX; // ���݂̃}�E�X�ʒu��X���W
				//y = ev.pageY; // ���݂̃}�E�X�ʒu��Y���W
				this.popOBJ.style.left = x + x_adjust + "px"; //�|�b�v�A�b�v�ʒu
				this.popOBJ.style.top = y + y_adjust + "px";
				//alert(window.pageYOffset);
				//alert(this.popOBJ.offsetTop);
				
				if ((this.popOBJ.offsetTop + this.popOBJ.offsetHeight) > (window.pageYOffset + window.innerHeight)) {
					this.popOBJ.style.top = window.pageYOffset + window.innerHeight - this.popOBJ.offsetHeight -20 + "px";
				}
				if (this.popOBJ.offsetTop < window.pageYOffset) {
					this.popOBJ.style.top = window.pageYOffset -2 + "px";
				}
				
			}
			this.popOBJ.style.visibility = "visible"; // ���X�|�b�v�A�b�v�\��
		}
    }
	
	/**
	 * ���X�|�b�v�A�b�v���\���^�C�}�[����
	 */
	ResPopUp.prototype.hideResPopUp = function () {
		this.hideTimerID = setTimeout("doHideResPopUp('" + this.divID + "')", delaySec); // ��莞�ԕ\�����������
	}

	/**
	 * ���X�|�b�v�A�b�v���\���ɂ���
	 */
	ResPopUp.prototype.doHideResPopUp = function () {

		for (i=0; i < gPOPS.length; i++) {
		
			if (this.zNum < gPOPS[i].zNum) {
				//clearTimeout(this.hideTimerID); // �^�C�}�[������
				this.hideTimerID = setTimeout("hideResPopUp('" + this.divID + "')", delaySec); // ��莞�ԕ\�����������
				return;
			}
		}
		
		this.popOBJ.style.visibility = "hidden"; // ���X�|�b�v�A�b�v��\��
		// clearTimeout(this.hideTimerID); // �^�C�}�[������
		gResPopCtl.rmResPopUp(this.divID);
	}
	
	return this;
}