if (window.history.replaceState) {
	window.history.replaceState(null, null, window.location.href);
}

const $panel = document.querySelector('[data-box="panel"]');

if ($panel) {
	const $deleteButton = $panel.querySelector('.delete');

	if ($deleteButton) {
		const warning = $deleteButton.dataset.warning;
		$panel.addEventListener('submit', (e) => {
			if (e.submitter == $deleteButton) {
				if (confirm(warning)) {
					$panel.submit();
				} else {
					e.preventDefault();
				}
			}
		});
	}

	const $titleInput = $panel.querySelector('#title');
	const $urlInput = $panel.querySelector('#via');

	if ($titleInput && $urlInput) {
		$urlInput.addEventListener('blur', () => {
			if ($titleInput.value.length == 0 &&
				$urlInput.value &&
				$urlInput.value.startsWith('https') &&
				$urlInput.validity.valid) {

				const $url = $urlInput.value;
				const xhr = new XMLHttpRequest();

				xhr.onreadystatechange = function() {
					if (this.readyState == 4 && this.status == 200) {
						if (this.responseText.length > 0) {
							$titleInput.value = this.responseText;
						}
					}
				};

				xhr.open('GET', '?title=' + $url, true);
				xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
				xhr.send();
			}
		});
	}
}
