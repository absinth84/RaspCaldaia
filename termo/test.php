
<script src=../lib/jquery.min.js></script>
<script src=../lib/rangeslider.min.js></script>

<link href='../lib/rangeslider.css' rel='stylesheet' type='text/css' />

<h2>Floating point boundaries</h2>
<br>
<br>
<input type="range" value="0.5" step="0.1" min="0.1" max="3.0">
<br>
<output>0.5</output>


<script>
$(function() {
  var output = document.querySelectorAll('output')[0];

  $(document).on('input', 'input[type="range"]', function(e) {
        output.innerHTML = e.currentTarget.value;
  });

  $('input[type=range]').rangeslider({
    polyfill: false
  });
});
</script>
