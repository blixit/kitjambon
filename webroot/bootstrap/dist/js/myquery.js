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