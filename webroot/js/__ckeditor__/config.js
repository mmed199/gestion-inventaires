/*
Copyright (c) 2003-2010, CKSource - Frederico Knabben. All rights reserved.
For licensing, see LICENSE.html or http://ckeditor.com/license
*/
 
CKEDITOR.editorConfig = function( config )
{
	// Define changes to default configuration here. For example:
	config.language = 'fr';
	config.toolbar = 'ImagesCatalog' ;
	config.toolbar_ImagesCatalog =
	[
	['Preview', 'Flash'],
    ['Cut','Copy','Paste','PasteText','PasteFromWord','-','Print', 'SpellChecker', 'Scayt'],
    ['Undo','Redo','-','Find','Replace','-','SelectAll','RemoveFormat'],
    ['Bold','Italic','Underline','Strike','-','Subscript','Superscript'],
    ['NumberedList','BulletedList','-','Outdent','Indent'],
    ['JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'],
    ['BidiLtr', 'BidiRtl'],
    ['Link','Unlink'],
    ['Image', 'Table','HorizontalRule','SpecialChar','PageBreak','Iframe'],
    '/',
    ['Styles','Format','Font','FontSize'],
    ['TextColor','BGColor'],
    ['Maximize', 'ShowBlocks']
 
	]
 
	config.filebrowserBrowseUrl = '/js/ckfinder/ckfinder.html';
	config.filebrowserImageBrowseUrl = '/js/ckfinder/ckfinder.html?type=Images';
	config.filebrowserFlashBrowseUrl = '/js/ckfinder/ckfinder.html?type=Flash';
	config.filebrowserUploadUrl = '/js/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files';
	config.filebrowserImageUploadUrl = '/js/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images';
	config.filebrowserFlashUploadUrl = '/js/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash';
};