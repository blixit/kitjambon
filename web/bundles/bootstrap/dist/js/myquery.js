	var loadSondageAction = function(){   
		$('.r').click(function(){   
			$("#content_sondage_question").fadeOut( 500 );
			$("#affichage_result_sondage").fadeIn(1000);
			var reponse = $(this).attr("id");  
			$('#close').click(function(){  
				var path = '';//$("#dir").val();  //defini dans search via dirheader dans un input hidden
				var idreponse = reponse;
				var idQuestion = $("#idQuestion").val();  
				
				var data = '&'+'idQuestion='+idQuestion+'&'+'idReponse='+reponse;		//	alert(data);	
				$.ajax({
					type : "GET", 
					url : path+"fonctions/result_sondage.php",
					data : data,
					success: function(server_response){
						$('#recharge_flux_sondage').load(path+'composants/mod_sondage.php'); 
						//$("#result_sondage").html(server_response).show(); //réponse du serveur
						//$('#result_sondage').load(path+'fonctions/result_sondage.php'); 
					}
				
				});
			});
			
		}); 	
	};
	$(document).ready(function(){
		loadSondageAction(); 
	});
	var searchFiles = function(toSearch){  
        $.ajax({
            type : 'GET',
            url : '?ajax/search_files/',
            data : toSearch,
            success : function(server_response){
                    $('#rien').load('?ajax/search_files/');
                    $('#resultSearch').html(server_response).fadeIn(2000);
                    $('#jumbotron').fadeOut(1000);
                }
        });
        //window.location.reload();  
    };
    
    /**
	* Fonction permettant de visualiser le contenu d'un fichier
	* @param title : le titre à mettre dans la fenetre qui s'ouvre, en général le nom du fichier
	* @param lien : l'url contenant la source du fichier à afficher
	* @param url_download : l'url permettant de télécharger le fichier
	* @param file_id : l'identitiand du fichier sur le serveur
	*/
	var showPDF = function(title,lien,url_download,file_id){
		//on affiche le modal qui permet de visualiser le fichier
		$('#modal_view').modal('show');
		//on change les données affichés dans le modal en fonctions des paramètres fournis
		$('#modal_view').on('shown.bs.modal', function () {
			//nom et date du fichier
		  	$('.modal-title').text(title[0]);
		  	$('.modal-date').text(title[1]);
		  	//lien de téléchargement du fichier
		  	$('#url_download').attr('href',url_download);
		  	//frame incluant l'object flash de google qui permet la visualisation du fichier
		  	$('#iframe').attr('src','http://docs.google.com/gview?url='+lien+'&embedded=true');
		  	//on charge les commentaires 
		  	$.ajax({
	            type : 'GET',
	            url : '?ajax/get_comment/',
	            data : 'file_id:'+file_id,
	            success : function(server_response){  
	                    $('.modal-commentaires').html(server_response).fadeIn(2000); 
	                },
	            error: function(XMLHttpRequest, textStatus, errorThrown) {  
	                    //alert("Status: " + textStatus); alert("Error: " + errorThrown); 
	                    $('.modal-commentaires').html('Aucun commentaire pour ce fichier, soyez le 1er à donner votre avis.').fadeIn(2000); 
	                } 
	        });
		})
	}
	
    /**
	* Fonction qui recharge les 2 divs qui empeche le copier-coller et le fullscreen sur les 
	* iframes de visualisation de fichiers. Cela empeche à l'utilisateur de modifier localement
	* son le code source des pages afin d'effectuer les actions interdites.
	*/
	var refresh_prevent_copies = function(){  
		var t1 = document.getElementById('prevent_copier_coller');
		var t2 = document.getElementById('prevent_full_screen');
		if(t1 != null)
			t1.style.display = "block";
		if(t2 != null)
			t2.style.display = "block";
	} 
	setInterval(refresh_prevent_copies,1000);

	/**
	* Fonction permettant de visualiser le contenu d'un fichier
	* @param user_id : l'identifiant de l'utilisateur
	* @param file_id : l'identifiant du fichier
	* @param comment : le texte du commentaire 
	*/
	var add_comment = function(user_id, file_id, comment){
		alert(comment);
		$.ajax({
            type : 'GET',
            url : '?ajax//',
            data : 'user_id:'+id_user+'/'+'file_id:'file_id+'/comment:'+comment,
            success : function(server_response){
                    //$('#rien').load('?ajax/search_files/');
                    $('#comment_server_response').html(server_response).fadeIn(2000);
                    //$('#jumbotron').fadeOut(1000);
                },
            error: function(XMLHttpRequest, textStatus, errorThrown){
            	$('#comment_server_response').html("Une erreur est survenue. Veuillez ressayer plus tard.").fadeIn(2000);
            }
        });
	}
			 