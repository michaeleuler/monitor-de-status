

//Dispositivos

// update servidor
(function($) {
	
  RemoveTableRow = function(handler) {
    var tr = $(handler).closest('tr');

    tr.fadeOut(400, function(){ 
      tr.remove(); 
    }); 

    return false;
  };
  
  AddTableRow = function() {

    var newRow = $("<tr>");
    var cols = "";

    cols += '<td><input type="text" id="servico" name="servico[]" placeholder="Serviço" class="form-control"/></td>';
    cols += '<td><input type="number" id="porta" name="porta[]" placeholder="Porta" class="form-control"/></td>';
    cols += '<td>';
    cols += '<button class="btn btn-large btn-danger" onclick="RemoveTableRow(this)" type="button"><span class=" glyphicon glyphicon-trash" aria-hidden="true"></span></button>';
    cols += '</td>';

    newRow.append(cols);
    $("#servicos_table").append(newRow);

    return false;
  };
  //add servidor
 AddTableRow2 = function() {

    var newRow = $("<tr>");
    var cols = "";

    cols += '<td><input type="text" id="servico" name="servico[]" placeholder="Serviço" class="form-control"/></td>';
    cols += '<td><input type="number" id="porta" name="porta[]" placeholder="Porta" class="form-control"/></td>';
    cols += '<td>';
    cols += '<button class="btn btn-large btn-danger" onclick="RemoveTableRow(this)" type="button"><span class=" glyphicon glyphicon-trash" aria-hidden="true"></span></button>';
    cols += '</td>';

    newRow.append(cols);
    $("#servicos_table2").append(newRow);

    return false;
  };  
})(jQuery);


// Add Record
function addRecord() {
    // get values
    var nome = $("#nome").val();
    var ip = $("#ip").val();
 	var desc = $("#desc").val();   	
	var prior = $("#prior").val();
	var tipo = $("#tipo").val();
    var virtual = $("#virtual").val();
	var email = $("#email").val();

//arrays de cadastro de serviço
	var servico = new Array();
    $("input[name='servico[]']").each(function(){
     servico.push($(this).val());
	});	
	var porta = new Array();  	
	$("input[name='porta[]']").each(function(){
     porta.push($(this).val());
	});

    // Add record
    $.post("servidores/addRecord.php", {
        nome: nome,
        ip: ip,
        desc: desc,
		prior: prior,		
        tipo: tipo,
        virtual: virtual,
        email: email,	
		'servico': servico,	
		'porta': porta,		
		

    }, function (data, status) {
        // close the popup
        $("#add_new_record_modal").modal("hide");

        // read records again
        readRecords();
		readRecords2();

		

        // clear fields from the popup
        $("#nome").val("");
        $("#ip").val("");
        $("#desc").val("");		
    });
}

// READ servidores
function readstatus() {
    $.get("servidores/status.php", {}, function (data, status) {
        $(".status_content").html(data);
	    });
}
function readRecords() {
    $.get("servidores/readRecords.php", {}, function (data, status) {
        $(".records_content").html(data);
	    });
}
// READ serviços
function readRecords2() {
    $.get("servicos/readservicos.php", {}, function (data, status) {
        $(".records_servicos").html(data);
    });
}
// READ user
function readRecords3() {
    $.get("usuarios/readRecords.php", {}, function (data, status) {
        $(".records_user").html(data);
    });
}
// READ eventos
function readEventos() {
    $.get("eventos/readRecords.php", {}, function (data, status) {
        $(".records_eventos").html(data);
    });
}

function DeleteUser(id) {
    var conf = confirm("Tem certeza que deseja excluir este dispositivo? Todos os dados serão perdidos.");
    if (conf == true) {
        $.post("servidores/deleteUser.php", {
                id: id
            },
            function (data, status) {
                // reload Users by using readRecords();
                readRecords();
				readRecords2();
				
						
            }
        );
    }
}

function GetUserDetails(id) {
		
    // Add User ID to the hidden field for furture usage
    $("#hidden_user_id").val(id);
    $.post("servidores/readUserDetails.php", {
            id: id
        },
        function (data, status) {
            // PARSE json data
            var user = JSON.parse(data);
            // Assing existing values to the modal popup fields
            $("#update_serv").val(user.id);	
			$("#update_nome").val(user.nome);
            $("#update_ip").val(user.ip);
            $("#update_desc").val(user.descricao);			
			$("#update_prior").val(user.prioridade);
            $("#update_tipo").val(user.tipo);
			$("#update_virtual").val(user.virtual);
			$("#update_email").val(user.notifica);	
			readRecords2();
        }	
    );

		
    // Open modal popup
	readRecords2();
  $("#update_user_modal").modal("show");
}
 
function UpdateUserDetails() {
    // get values
    var nome	 = $("#update_nome").val();
    var ip		 = $("#update_ip").val();
	var desc 	 = $("#update_desc").val();  	
    var prior	 = $("#update_prior").val();
	var tipo 	 = $("#update_tipo").val();
    var virtual	 = $("#update_virtual").val();
	var email 	 = $("#update_email").val();

//add serviços	
	var servico = new Array();
    $("input[name='servico[]']").each(function(){
     servico.push($(this).val());
  });	
	var porta = new Array();  	
  $("input[name='porta[]']").each(function(){
     porta.push($(this).val());
  });

    // get hidden field value
    var id = $("#hidden_user_id").val();

    // Update the details by requesting to the server using ajax
	
    $.post("servidores/updateUserDetails.php", {
            id: id,
			nome: nome,
			ip: ip,
			desc: desc,
			prior: prior,		
			tipo: tipo,
			virtual: virtual,
			email: email,		
			'servico': servico,	
			'porta': porta

        },
        function (data, status) {
            // hide modal popup
            $("#update_user_modal").modal("hide");
            // reload Users by using readRecords();
            readRecords();
			readRecords2();
	
        }
    );
}

//eventos --------------------------------------------------------------------------------------------------------------

function GetEventDetails(id) {
		
    // Add User ID to the hidden field for furture usage
    $("#hidden_user_id").val(id);
    $.post("eventos/readUserDetails.php", {
            id: id
        },
        function (data, status) {
            // PARSE json data
            var user = JSON.parse(data);
            // Assing existing values to the modal popup fields
            $("#dispo").val(user.nome);	
			$("#servi").val(user.servicos);
            $("#tipo_ocorrencia").val(user.tipo);
            $("#motivo").val(user.motivo);		
            $("#solucao").val(user.solucao);				
			$("#inicio").val(user.inicio);
            $("#fim").val(user.fim);
			readEventos();
        }	
    );

		
    // Open modal popup
	readEventos();
  $("#update_event_modal").modal("show");
}
 
function UpdateEventDetails() {
    // get values
 	var tipo 	 = $("#tipo_ocorrencia").val();  	
	var motivo 	 = $("#motivo").val();
	var solucao 	 = $("#solucao").val();	
	var fim 	 = $("#fim").val();

    // get hidden field value
    var id = $("#hidden_user_id").val();

    // Update the details by requesting to the server using ajax
	
    $.post("eventos/updateUserDetails.php", {
            id: id,
			tipo: tipo,
			motivo: motivo,		
			solucao: solucao,				
			fim: fim

        },
        function (data, status) {
            // hide modal popup
            $("#update_event_modal").modal("hide");
            // reload Users by using readRecords();
			readEventos();
	
        }
    );
}



function searchEvent() {
    // get values
	var dispositivo = $("#search_dispositivo").val();		
 	var tipo 	    = $("#search_tipo").val();  	
	var motivo 	 	= $("#search_motivo").val();
	var de 	 		= $("#de").val();
	var ate 	 	= $("#ate").val();	

    $.post("eventos/readRecords.php", {
			dispositivo: dispositivo,		
			tipo: tipo,				
			motivo: motivo,
			de: de,
			ate: ate
        },
		 function (data, status) {
            // hide modal popup
					$(".records_eventos").html(data);
			$("#search_eventos").modal("hide");
            // reload Users by using readRecords();
	        }
    );
}

//servicos--------------------------------------------------------------------------------------------------------------

function addRecord2() {
    // get values
    var servico = $("#servico").val();
    var porta = $("#porta").val();
    var servidor = $("#servidor").val();	


    // Add record
    $.post("servicos/addRecord.php", {
        servico: servico,
		porta: porta,
        servidor: servidor,

    }, function (data, status) {
        // close the popup
        $("#add_new_record_modal2").modal("hide");

        // read records again
    readRecords(); 
	readRecords2();

		

        // clear fields from the popup
        $("#servico").val("");
        $("#porta").val("");
        $("#servidor").val("");		
    });
}

function DeleteUser2(id) {
    var conf = confirm("Tem certeza que deseja excluir este servidor?");
    if (conf == true) {
        $.post("servicos/deleteUser.php", {
                id: id
            },
            function (data, status) {
                // reload Users by using readRecords2();
    readRecords(); 
	readRecords2();

            }		
        );
    }
}

function GetUserDetails2(id) {
    // Add User ID to the hidden field for furture usage
    $("#hidden_user_id").val(id);
    $.post("servicos/readUserDetails.php", {
            id: id
        },
        function (data, status) {
            // PARSE json data
            var user = JSON.parse(data);
            // Assing existing values to the modal popup fields
            $("#update_servico").val(user.servico);
            $("#update_porta").val(user.porta);
			$("#update_servidor").val(user.servidor);
        }
    );
    // Open modal popup
    $("#update_user_modal2").modal("show");
}

function UpdateUserDetails2() {
    // get values
    var servico = $("#update_servico").val();
    var porta = $("#update_porta").val();
	var servidor = $("#update_servidor").val();


    // get hidden field value
    var id = $("#hidden_user_id").val();

    // Update the details by requesting to the server using ajax
    $.post("servicos/updateUserDetails.php", {
            id: id,
            servico: servico,
            porta: porta,
			servidor: servidor
        },
        function (data, status) {
            // hide modal popup
            $("#update_user_modal2").modal("hide");
            // reload Users by using readRecords2();
    readRecords(); 
	readRecords2();

        }
    );
}


//Sistema---------------------------------------------------------------------------------------------------------
function UpdateSistema() {
    // get values
	var smtp_id = $("#smtp_id").val();
    var serv_smtp = $("#serv_smtp").val();
    var porta_smtp = $("#porta_smtp").val();
    var user_smtp = $("#user_smtp").val();	
	var senha_smtp = $("#senha_smtp").val();


    // Update the details by requesting to the server using ajax
    $.post("sistema/update.php", {
            smtp_id: smtp_id,
            serv_smtp: serv_smtp,
            porta_smtp: porta_smtp,
			user_smtp: user_smtp,
			senha_smtp: senha_smtp
        },
        function (data, status) {
            // hide modal popup
            $("#update_user_modal").modal("hide");
            // reload Users by using readRecords();
            readRecords();
			readRecords2();
	
        }
    );
}

//user---------------------------------------------------------------------------------------------------------
function addRecord3() {
    // get values
    var nome_user = $("#nome_user").val();
    var email_user = $("#email_user").val();
    var senha_user = $("#senha_user").val();	
	var nivel_user = $("#nivel_user").val();	


    // Add record
    $.post("usuarios/addRecord.php", {
        nome_user: nome_user,
		email_user: email_user,
        senha_user: senha_user,
		nivel_user: nivel_user,

    }, function (data, status) {
        // close the popup
        $("#add_new_user").modal("hide");

        // read records again
	readRecords3();			

        // clear fields from the popup
        $("#nome_user").val("");
        $("#email_user").val("");
        $("#senha_user").val("");
		$("#nivel_user").val("");		
    });
}

function DeleteUser3(id) {
    var conf = confirm("Tem certeza que deseja excluir este servidor?");
    if (conf == true) {
        $.post("usuarios/deleteUser.php", {
                id: id
            },
            function (data, status) {
                // reload Users by using readRecords2();

	readRecords3();	

            }		
        );
    }
}

function GetUserDetails3(id) {
    // Add User ID to the hidden field for furture usage
    $("#hidden_user_id").val(id);
    $.post("usuarios/readUserDetails.php", {
            id: id
        },
        function (data, status) {
            // PARSE json data
            var user = JSON.parse(data);
            // Assing existing values to the modal popup fields
            $("#update_nome_user").val(user.nome);
            $("#update_email_user").val(user.email);
			$("#update_senha_user").val(user.senha);
			$("#update_nivel_user").val(user.nivel);			
        }
    );
    // Open modal popup
    $("#update_user").modal("show");
}

function UpdateUserDetails3() {
    // get values
    var nome = $("#update_nome_user").val();
    var email = $("#update_email_user").val();
	var senha = $("#update_senha_user").val();
	var nivel = $("#update_nivel_user").val();


    // get hidden field value
    var id = $("#hidden_user_id").val();

    // Update the details by requesting to the server using ajax
    $.post("usuarios/updateUserDetails.php", {
            id: id,
            nome: nome,
            email: email,
			senha: senha,
			nivel: nivel			
        },
        function (data, status) {
            // hide modal popup
            $("#update_user").modal("hide");
            // reload Users by using readRecords2();
	readRecords3();	

        }
    );
}

$(document).ready(function () {
    // READ recods on page load
    readRecords(); 
	readRecords2();
	readRecords3();	
	readstatus();
	readEventos()	

});


//login---------------------------------------------------------------------------------------------------------

