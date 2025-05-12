if (window.history.replaceState) {
	window.history.replaceState(null, null, window.location.href);
}

const $panel = document.querySelector('.panel');
const $button = $panel.querySelector('.delete');
if ($panel && $button) {
	const warning = $button.dataset.warning;
	$panel.addEventListener('submit', (e) => {
		if (e.submitter == $button) {
			if (confirm(warning)) {
				$panel.submit();
			} else {
				e.preventDefault();
			}
		}
	});
}
