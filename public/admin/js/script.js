/************************************/
/************** EVENTS **************/
/************************************/

// Event when the document is ready

$(document).ready(function() {
	showHideActionsButtons();
	confirmDeleteCustom();
	uploadImagePreview();
	uploadImagesMultiplePreview();
	resizeImagesMultiplePreview();
	showHideFormPage();
	generateUniqueProfessionalId();
	processStock();
	$('[data-toggle="tooltip"]').tooltip(); 

	// Event when the window is resize
	$(window).resize(function() {
		showHideActionsButtons();
		resizeImagesMultiplePreview();
	});

	// Loader animation
	$('a:not(.dropdown-toggle), .btn').click(function() {
		Pace.restart();
	})
});


/***************************************/
/************** FUNCTIONS **************/
/***************************************/

// Show/Hide Actions Buttons on mobiles and tablets

function showHideActionsButtons() {
	if($(window).width() >= 1200) {
		$('.top-right').hide();
		$('.content').hover(function() {
			$(this).find('.top-right').show();
		}, function() {
			$('.top-right').hide();
		});
	}
	else {
		$('.top-right').show();
	}
}

// Confirm custom pop-up for delete entry

function confirmDeleteCustom() {
	$("a[data-bb='confirm']").click(function() {
	    var that = $(this);
	    bootbox.confirm({
		    size: 'small',
		    message: "Voules-vous supprimer?",
			buttons: {
				confirm: {
				    label: 'Oui',
				    className: "btn-danger"
				},
				cancel: {
				    label: 'Non'
				}
			},
		    callback: function(result){
			    if(result == true) {
				    $('#form_'+that.data('id')).submit();
			    }
			}
		});
    });
}

// Preview for the simple upload of the first image for a page

function uploadImagePreview() {
	$("#uploadFile").on("change", function() {
        var files = !!this.files ? this.files : [];
        if (!files.length || !window.FileReader) return;
        if (/^image/.test(files[0].type)) {
            var reader = new FileReader();
            reader.readAsDataURL(files[0]);
            reader.onloadend = function() {
                $("#imagePreview").css("background-image", "url("+this.result+")");
                $("#imagePreview").append('<div onclick="removeImagePreview(this)" class="position-center"><a class="btn btn-xs btn-danger"><span class="fa fa-times"></span></a></div>');
            }
        }
    });
}

// Remove image when cliquing on remove image

function removeImagePreview(item) {
	$("#imagePreview").children().remove();
	$("#imagePreview").css("background-image", "url(http://placehold.it/100x100?text=/)");
	$("#uploadFile").val('');
	$("#remove_photo").val(true);
}

// Preview for the multiple upload of images for a page

var finalFiles = {};

function uploadImagesMultiplePreview() {
	$("#imagesPreview").on('change', function(e) {
		finalFiles = {};
		$('[id^=file_]').remove();
		var files = this.files;

		$.each(files, function(idx, elm){
			finalFiles[idx]=elm;
		});

		for(var i=0; i<files.length; i++) {
			if (/^image/.test(files[i].type)) {
	            var reader = new FileReader();
	            reader.readAsDataURL(files[i]);
	            reader.i = i;
	            reader.onloadend = function(e, i) {
	                $("#filename").append('<div id="file_'+ e.target.i +'" class="col-lg-2 col-md-2 col-sm-4 col-xs-6 m-b-15"><div class="img-circle imagePreview" style="background-image:url('+e.target.result+');"><div class="position-center"><a onclick="removeImageMultiplePreview(this)" class="btn btn-xs btn-danger"><span class="fa fa-times"></span></a></div></div></div>');
	                resizeImagesMultiplePreview();
	            }
	        }
		}
	});
}

// Change image preview height

function resizeImagesMultiplePreview() {
	$("#filename .imagePreview").each(function() {
        $(this).css({'height':$(this).width()+'px'});
    })
}

// Remove image when cliquing on remove image

function removeImageMultiplePreview(item) {
	$("#imagesPreview").val('');
	var parent = $(item).parent().parent().parent();
	var index = parent.attr("id").split('_')[1];
	parent.remove();

	delete finalFiles[index];
}

// Remove image if image already exists to memory of the id

function removeImageExistsPreview(item) {
	var parent = $(item).parent().parent().parent();
	var value = $("#remove_photos").val();
	if(value.length != 0) {
		value += '-';
	}
	value += parent.attr("id");
	$("#remove_photos").val(value);
	parent.remove();
}

// Show/Hide form page

function showHideFormPage() {
	hideFormsPage();
	processFormsPage();
	$("#typesPages").on('change', function(e) {
		clearFormsPage();
		processFormsPage();
	});
}

// Hide all forms page

function hideFormsPage() {
	$(".typeAccueil").hide();
	$(".typeArticle").hide();
	$(".typeList").hide();
	$(".typeContact").hide();
	$(".typeFooter").hide();
}

// Process for show/hide form page

function processFormsPage() {
	if($("#typesPages option:selected").val() == 1) {
		changeClassPage('col-lg-12 col-md-12 col-sm-12 col-xs-12');
		hideFormsPage();
		$(".typeAccueil").show();
	}
	else if($("#typesPages option:selected").val() == 2) {
		changeClassPage('col-lg-9 col-md-8 col-sm-8 col-xs-12');
		hideFormsPage();
		$(".typeArticle").show();
	}
	else if($("#typesPages option:selected").val() == 3) {
		changeClassPage('col-lg-12 col-md-12 col-sm-12 col-xs-12');
		hideFormsPage();
		$(".typeList").show();
	}
	else if($("#typesPages option:selected").val() == 4) {
		changeClassPage('col-lg-12 col-md-12 col-sm-12 col-xs-12');
		hideFormsPage();
		geoComplete();
		$(".typeContact").show();
	}
	else if($("#typesPages option:selected").val() == 5) {
		changeClassPage('col-lg-12 col-md-12 col-sm-12 col-xs-12');
		hideFormsPage();
		$(".typeFooter").show();
	}
}

// Animation change if image solo exists

function changeClassPage(items) {
	$('#gridAnim').removeClass();
	$('#gridAnim').addClass(items);
}

// Clear all inputs in form page

function clearFormsPage() {
	$(".typeAccueil input, .typeArticle input, .typeArticle textarea, .typeList input, .typeContact input, .typeFooter input").val('');
	$('#visible').prop('checked', 0);
	$("#imagesPreview").val('');
	$('[id^=file_]').remove();
}

function geoComplete() {
	var options = {
        zoom: 10,
        center: new google.maps.LatLng(43.1167, 6.1167),
        streetViewControl: false,
		mapTypeControlOptions: {
			mapTypeIds: []
		},
        styles: [{"elementType":"geometry","stylers":[{"hue":"#ff4400"},{"saturation":-68},{"lightness":-4},{"gamma":0.72}]},{"featureType":"road","elementType":"labels.icon"},{"featureType":"landscape.man_made","elementType":"geometry","stylers":[{"hue":"#0077ff"},{"gamma":3.1}]},{"featureType":"water","stylers":[{"hue":"#00ccff"},{"gamma":0.44},{"saturation":-33}]},{"featureType":"poi.park","stylers":[{"hue":"#44ff00"},{"saturation":-23}]},{"featureType":"water","elementType":"labels.text.fill","stylers":[{"hue":"#007fff"},{"gamma":0.77},{"saturation":65},{"lightness":99}]},{"featureType":"water","elementType":"labels.text.stroke","stylers":[{"gamma":0.11},{"weight":5.6},{"saturation":99},{"hue":"#0091ff"},{"lightness":-86}]},{"featureType":"transit.line","elementType":"geometry","stylers":[{"lightness":-48},{"hue":"#ff5e00"},{"gamma":1.2},{"saturation":-23}]},{"featureType":"transit","elementType":"labels.text.stroke","stylers":[{"saturation":-64},{"hue":"#ff9100"},{"lightness":16},{"gamma":0.47},{"weight":2.7}]}]
    };

	var map = new google.maps.Map(document.getElementById("map"), options);

	$("#address").geocomplete({
		map: "#map",
		mapOptions: options,
		markerOptions: {
			draggable: true,
			position: new google.maps.LatLng($('#latitude').val(), $('#longitude').val())
		}
	}).bind("geocode:result", function(event, result){
		$('#latitude').val(result.geometry.location.lat());
		$('#longitude').val(result.geometry.location.lng());
	}).bind("geocode:dragged", function(event, result){
		$('#latitude').val(result.lat());
		$('#longitude').val(result.lng());
	});
}

function generateUniqueProfessionalId() {
	if($('#codeProfessional').val() == '') {
		generateCode();
	}
	$('#generateUniqueId').click(function() {
		generateCode();
	});
}

function generateCode() {
	var text = "";
    var possible = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789@";

    for(i=0;i<8;i++) {
	    text += possible.charAt(Math.floor(Math.random() * possible.length));
    }

    $('#codeProfessional').val(text);
}

function processStock() {
	$('.processStock').each(function(num, item) {
		if(!$(item).find('input[type=checkbox]').is(':checked')) {
			$(item).find('input[type=text]').attr('disabled', true);
		}
		else {
			$(item).find('input[type=text]').attr('disabled', false);
		}

		$(item).find('input[type=checkbox]').click(function() {
			if($(this).is(':checked')) {
				$(item).find('input[type=text]').attr('disabled', false);
				$(item).find('input[type=text]').val(0);
			}
			else {
				$(item).find('input[type=text]').attr('disabled', true);
				$(item).find('input[type=text]').val('');
			}
		});
	});
}
