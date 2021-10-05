/**
 * @license Copyright (c) 2003-2021, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see https://ckeditor.com/legal/ckeditor-oss-license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#AADC6E';

	config.filebrowserUploadUrl      = 'http://127.0.0.1:8000/imageupload',
	config.filebrowserImageUploadUrl = '/upload.do?type=Images',
	config.filebrowserUploadMethod='form'; //파일 오류났을때 alert띄워줌

	
	config.allowedContent = true;
	CKEDITOR.dtd.$removeEmpty.span = 0;
	config.enterMode = CKEDITOR.ENTER_BR;
};
