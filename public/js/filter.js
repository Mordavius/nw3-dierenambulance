function deleteTicket(ticketid) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    var conf =  confirm("Klik op OK om de melding te verwijderen!");
    if (conf == true) {
        var trdel = document.getElementById('trdel' + ticketid);
        trdel.parentNode.removeChild(trdel);
        $.ajax({
            type: 'DELETE',
            url: '/tickets/' + ticketid,
            success: function (data) {
                alert(data);
            }
        })
    }
}

function filterTickets() {
    let datefield = $('#date').val();
    let animalfieldvalue = $('#animal_species').val();
    let locationfield = $('#location').val();

	// create search url
	var url = 'api/ticketfilter/?';

	if (datefield) {
		url += '&date='+ datefield;
	}
    if (animalfieldvalue) {
    	url += '&animal=' + animalfieldvalue;
    }
    if (locationfield) {
	    url += '&city=' + locationfield;
    }

	$.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        type: 'GET',
        url: url,
        success: function (data) {
            let finishedgrid = $('#finished')[0];
            let unfinishedgrid = $('#unfinished')[0];
            let number_results = $('#number_results');

            if (finishedgrid != null && unfinishedgrid != null) {
                finishedgrid.innerHTML = '';
                unfinishedgrid.innerHTML = '';
                let selectedgrid;
                let unfinished_counter = 0;

                data.forEach(function (ticket) {
	                if(ticket.finished === 0){
		                selectedgrid = unfinishedgrid;
		                unfinished_counter++;
	                }
	                else if (ticket.finished === 1){
		                selectedgrid = finishedgrid;
	                }
	                selectedgrid.innerHTML +=
		                '<a href="/melding/'+ticket.id+'/edit">' +
			                '<article class="grid_ticket">' +
				                '<div class="test">' +
				                '</div>' +
				                '<div class="ticket_number">#' + ticket.id + '</div>' +
				                '<div class="grid_animal_icon">' +
					                '<div class="ticket_icon">' +
					                    '<img src="/images/'+ticket.animal.animal_species+'.svg" id="animal_icon">' +
					                '</div>' +
				                '</div>' +
				                '<div class="ticket_main_info">' +
					                '<div class="ticket_title">' +
		                                '<h3>'+ticket.animal.animal_species+'</h3>' +
		                                '<span class="subheading">'+ticket.animal.breed+'</span>' +
		                            '</div>' +
					                '<div class="ticket_address"><span>' +
						                ticket.destinations[0].address + ' ' + ticket.destinations[0].house_number + ', <br />' +
						                ticket.destinations[0].postal_code + ' ' +
						                ticket.destinations[0].city +
					                '</span></div>' +
		                            '<p class="ticket_description">'+ticket.animal.description.substr(0, 200) +'</p>' +
				                '</div>'+
			                '</article>' +
		                '</a>';
                });

	            number_results.innerHTML = unfinished_counter;
            }
        }
    });
}

function resetFilter(){
    location.reload(true);
}
