
<div class="container">
  <br/>
  <select class="itemName form-control" style="width:500px;" name="itemName"></select>
</div>


<script type="text/javascript">
      $('.itemName').select2({
        placeholder: 'Select an item',
        ajax: {
          url: '/search_clients_ajax',
          dataType: 'json',
          delay: 250,
          processResults: function (data) {
            return {
              results:  $.map(data, function (item) {
                    return {
                        text: item.name,
                        id: item.id
                    }
                })
            };
          },
          cache: true
        }
      });
</script>