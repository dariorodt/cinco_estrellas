Redirecting to webpay... please wait.

<form action="{{ $url_redirection }}" method="POST" id="return-form">
	<input type="hidden" name="token_ws" value="{{ $token_ws }}">
</form>

<script>
	document.getElementById('return-form').submit();
</script>