
  function visualiserOffre(idOffre) {
        
        $.ajax({
            url: "visualiser-offre",
            method: "get",
            data:{idOffre:idOffre}
        }).done(function () {
//         $('#myModal').modal('show');
        });
    }
