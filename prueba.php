<input type="checkbox" id="miCheckbox" />
<script>
  function activarCheckbox(valor) {
    document.getElementById('miCheckbox').checked = valor;
  }

  const N = 1; // Valor de la variable
  activarCheckbox(N === 2);
</script> 