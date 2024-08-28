document.getElementById('massDelete').addEventListener('click', function() {
      var checkboxes = document.querySelectorAll('.delete-checkbox:checked');
      var ids = [];
      checkboxes.forEach(function(checkbox) {
          ids.push(checkbox.getAttribute('data-id'));
      });
  
      if (ids.length > 0) {
          var xhr = new XMLHttpRequest();
          xhr.open('POST', 'delete-products.php', true);
          xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
          xhr.onload = function() {
              if (xhr.status === 200) {
                  location.reload();
              }
          };
          xhr.send('ids=' + JSON.stringify(ids));
      }
  });
  