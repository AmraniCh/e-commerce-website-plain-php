$(function(){

    Notifications();
    NotificationsCout();

    $(".badge-pill").on("click", function(){

      var adm = $("input[name='HSV']").val();

      $(location).attr("href", "notifications.php?admin="+adm);

    });

    $(document).on("click", function(event){
        var element = $(event.target);

        if( !element.parents().hasClass("notification-li")){
            
            if($(".notification-ctr").css("display") == "block"){

                $.post(
                  "includes/notifications_xhr",
                  { function: "NotificationsVues" },
                  function(data){
                    NotificationsCout();
                  },
                  "JSON"
                );
              }
            
            $(".notification-ctr").hide();
        
            
            
        }
        


    });

    $(".notification-li").on("click", function(){
      $(".notification-ctr").toggle();
      if($(".notification-ctr").css("display") == "none"){
        $.post(
          "includes/notifications_xhr",
          { function: "NotificationsVues" },
          function(data){
            NotificationsCout();
          },
          "JSON"
        );
      }
    });
        
});

function Notifications(){
  $.post(
    "includes/notifications_xhr", 
    {
      function: "AfficherNotifications"
    },
    function (data) {
        console.log(data);
      if(data != null){
        $.each(data.data, function (index, element) {

          switch (data.data[index]['type']) {

            case "commentaire":
              var html = '<div class="dropdown-divider"></div><a class="dropdown-item preview-item"><div class="preview-thumbnail"><div class="preview-icon bg-warning"> <i class="mdi mdi-comment-text-outline mx-0"></i></div></div><div class="preview-item-content"> <h6 class="preview-subject font-weight-medium text-dark">' + data.data[index]['titre'] + '</h6><p class="font-weight-light small-text"> ' + data.data[index]['passed_time'] + ' ' + data.data[index]['unit'] + '</p></div></a>';

              $(".notification-ctr").append(html);
              break;

            case "client":
              var html = '<div class="dropdown-divider"></div><a class="dropdown-item preview-item"> <div class="preview-thumbnail"> <div class="preview-icon bg-info"> <i class="mdi mdi-account-plus mx-0"></i> </div></div><div class="preview-item-content"> <h6 class="preview-subject font-weight-medium text-dark">' + data.data[index]['titre'] + '</h6> <p class="font-weight-light small-text">' + data.data[index]['passed_time'] + ' ' + data.data[index]['unit'] + '</p></div></a>';

              $(".notification-ctr").append(html);
              break;

            case "commande":
              var html = '<div class="dropdown-divider"></div><a class="dropdown-item preview-item"> <div class="preview-thumbnail"> <div class="preview-icon bg-success"> <i class="mdi mdi-ticket-confirmation mx-0"></i> </div></div><div class="preview-item-content"> <h6 class="preview-subject font-weight-medium text-dark">' + data.data[index]['titre'] + '</h6> <p class="font-weight-light small-text"> ' + data.data[index]['passed_time'] + ' ' + data.data[index]['unit'] + '</p></div></a>';

              $(".notification-ctr").append(html);
              break;
              
            case "stock":
              var html = '<div class="dropdown-divider"></div><a class="dropdown-item preview-item"> <div class="preview-thumbnail"> <div class="preview-icon bg-danger"> <i class="mdi mdi-alert-circle-outline mx-0"></i> </div></div><div class="preview-item-content"><h6 class="preview-subject font-weight-medium text-dark">' + data.data[index]['titre'] + '</h6> <p class="font-weight-light small-text">' + data.data[index]['passed_time'] + ' ' + data.data[index]['unit'] + '</p></div></a>';
              
              $(".notification-ctr").append(html);
              break;
                  
            case "erreur[php_mailer]":
              var html = '<div class="dropdown-divider"></div><a class="dropdown-item preview-item"> <div class="preview-thumbnail"> <div class="preview-icon bg-danger"> <i class="mdi mdi-alert-circle-outline mx-0"></i> </div></div><div class="preview-item-content"><h6 class="preview-subject font-weight-medium text-dark">' + data.data[index]['titre'] + '</h6> <p class="font-weight-light small-text">' + data.data[index]['passed_time'] + ' ' + data.data[index]['unit'] + '</p></div></a>';
              
              $(".notification-ctr").append(html);
              break;

          }

        });
      }
    },
    "JSON"
  );
}

function NotificationsCout(){
  $.post(
    "includes/notifications_xhr", {
      function: "NbNotification"
    },
    function (data) {
      $(".not-count").text(data[0].nb_not);
      $(".not-commandes-count").text(' (' + data[0].nb_commandes + ')');
      $(".not-comment-count").text(' (' + data[0].nb_commentaires + ')');
    },
    "json"
  );
}