CKEDITOR.editorConfig = function(config)
{
	config.language = 'fr';
	config.entities_latin = false;
	config.width = 750;
	config.height = 200;
	config.skin = 'sce';
	config.toolbar_App =
	[
	   // ['Source','-','Save','Preview','-','About'],
	    ['Cut','Copy','Paste'],
	    ['Undo','Redo'],

	    ['Bold','Italic','Underline','Strike','-','Subscript','Superscript'],
	    ['NumberedList','BulletedList','-','Outdent','Indent','Blockquote'],
	    //['JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock'],
	    ['Link','Unlink'],
	    ['HorizontalRule','SpecialChar'],
	   // ['Format'],
	    ['TextColor','BGColor'],
	    ['Maximize', 'ShowBlocks']
	];
	config.toolbar = 'App';
};