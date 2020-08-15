<div class="flash-msg">
  @if (session('success'))
  <div class="pop pop-info">
    {{ session('success') }}
    <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
  </div>
  @endif
  @if (session('error'))
  <div class="pop pop-error">
    {{ session('error') }}
    <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
  </div>
  @endif
</div>
