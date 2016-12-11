  function visualiserOffre(idOffre) {
        $.ajax({
            url: "visualiser-offre",
            method: "get",
            data:{idOffre:idOffre}
        }).done(function (response) {
            template = JSON.parse(response).data;
            $('.modal-body').html(template);
         $('#myModal').modal('show');
        });
    }
