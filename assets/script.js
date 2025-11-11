if (window.history.replaceState) {
	window.history.replaceState(null, null, window.location.href);
}

const $panel = document.querySelector('[data-box="panel"]');

if ($panel) {
	const $deleteButton = $panel.querySelector('.delete');

	if ($deleteButton) {
		const warning = $deleteButton.dataset.warning;
		$panel.addEventListener('submit', (e) => {
			if (e.submitter === $deleteButton) {
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
		const maxLength = $titleInput.maxLength;
		$urlInput.addEventListener('blur', () => {
			if ($titleInput.value.length === 0 &&
				$urlInput.value &&
				$urlInput.value.startsWith('https') &&
				$urlInput.validity.valid) {

				const $url = $urlInput.value;
				const xhr = new XMLHttpRequest();

				xhr.onreadystatechange = function() {
					if (this.readyState === 4 && this.status === 200 && this.responseText.length > 0) {
						const response = this.responseText;
						const title = (response.length > maxLength) ? `${response.substring(0, maxLength - 1)}…` : response;
						$titleInput.value = title;
					}
				};

				xhr.open('GET', '?title=' + $url, true);
				xhr.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
				xhr.send();
			}
		});
	}
}
