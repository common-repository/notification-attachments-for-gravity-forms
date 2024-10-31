/*
Media Selector
Plugin: Notification Attachments for Gravity Forms
Since: 0.1 
Author: KGM Servizi
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html
*/

function kgm_add_attachment() {
	var mediaframes = wp.media.frames.items = wp.media({
		'multiple': true
	});
	mediaframes.on('select', function() {
		var attachment = mediaframes.state().get('selection').toJSON();			
		for(var i = 0; i < mediaframes.state().get('selection').length; i++)
		{
			var currentIDS = jQuery('#attachment_ids').val();

			if (currentIDS == '') {
				currentIDS = currentIDS+attachment[i].id				   
			} else {
				currentIDS = currentIDS+','+attachment[i].id
			}

			if (attachment[i].sizes) {
				if (attachment[i].sizes.thumbnail !== undefined  ) url_image=attachment[i].sizes.thumbnail.url; 
	    		else if (attachment[i].sizes.medium !== undefined ) url_image=attachment[i].sizes.medium.url;
	    		else if (attachment[i].sizes.full !== undefined ) url_image=attachment[i].sizes.full.url;
	    	} else {
	    		url_image=attachment[i].icon;
	    	} 

			jQuery('#attachment_ids').val(currentIDS);
			jQuery('.details').append('<li data-id="'+attachment[i].id+'"><img src="'+url_image+'" style="max-width:150px;" /></br>'+attachment[i].title+' <b>['+attachment[i].mime+']</b><div class="remove dashicons dashicons-dismiss" onClick="kgm_remove_attachment(this)"></div></li>');
		}				
	});
	mediaframes.open();
}

function kgm_remove_attachment(id) {
	var old = jQuery(id).parent();
	old.remove();

	var currentIDS = '';
	jQuery('.details li').each(function(){
		if (currentIDS == '') {
			currentIDS = currentIDS+jQuery(this).data('id');
		} else {
			currentIDS = currentIDS+','+jQuery(this).data('id')
		}
	});
	jQuery('#attachment_ids').val(currentIDS);
}