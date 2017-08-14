<footer class="text-center" style="width:100%" id="footer">
  &copy; Copyright <?php echo date('Y'); ?> Ipheya
</footer>
<script type="text/javascript">
  function updateAddresses()
  {
    var res = '';
    var pos = '';
    if($('#modal-residential').val()!='')
    {
      res += $('#modal-residential').val();
    }
    $('#residential').val(res);
    if($('#modal-postal').val()!='')
    {
      pos += $('#modal-postal').val();
    }
    $('#postal').val(pos);
  }

  function updateRoles()
  {
    var roles = '';
    for(var i = 1;i<=3;i++)
    {
      if($('#roles'+i).val()!='')
      {
        roles += $('#roles'+i).val()+',';
      }
    }
    $('#roles').val(roles);
  }
</script>
</body>
