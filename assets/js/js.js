(function () {
	function setupSlider(root, previousSelector, nextSelector, statusSelector, itemSelector) {
		if (!root) {
			return;
		}

		var items = Array.prototype.slice.call(root.querySelectorAll(itemSelector));
		if (!items.length) {
			return;
		}

		var previous = root.querySelector(previousSelector);
		var next = root.querySelector(nextSelector);
		var status = root.querySelector(statusSelector);
		var currentIndex = items.findIndex(function (item) {
			return item.classList.contains('is-active');
		});

		if (currentIndex < 0) {
			currentIndex = 0;
			items[0].classList.add('is-active');
		}

		function render() {
			items.forEach(function (item, index) {
				item.classList.toggle('is-active', index === currentIndex);
			});

			if (status) {
				status.textContent = currentIndex + 1 + ' / ' + items.length;
			}
		}

		function onNavigate(step, event) {
			if (event) {
				event.preventDefault();
			}

			currentIndex = (currentIndex + step + items.length) % items.length;
			render();
		}

		if (previous) {
			previous.addEventListener('click', onNavigate.bind(null, -1));
		}

		if (next) {
			next.addEventListener('click', onNavigate.bind(null, 1));
		}

		render();
	}

	function setupTabs(root) {
		if (!root) {
			return;
		}

		var triggers = Array.prototype.slice.call(root.querySelectorAll('.moxy-tab-trigger'));
		var panels = Array.prototype.slice.call(root.querySelectorAll('.moxy-tab-panel'));

		if (!triggers.length || !panels.length) {
			return;
		}

		function activate(index) {
			triggers.forEach(function (trigger, triggerIndex) {
				trigger.classList.toggle('is-active', triggerIndex === index);
			});

			panels.forEach(function (panel, panelIndex) {
				panel.classList.toggle('is-active', panelIndex === index);
			});
		}

		triggers.forEach(function (trigger, index) {
			trigger.addEventListener('click', function (event) {
				event.preventDefault();
				activate(index);
			});
		});

		activate(triggers.findIndex(function (trigger) {
			return trigger.classList.contains('is-active');
		}) || 0);
	}

	function setupBookingModal() {
		var modal = document.querySelector('.js-booking-modal');
		if (!modal) {
			return;
		}

		var openers = Array.prototype.slice.call(document.querySelectorAll('.js-booking-open'));
		var closers = Array.prototype.slice.call(modal.querySelectorAll('.js-booking-close'));

		function openModal(event) {
			if (event) {
				event.preventDefault();
			}

			modal.classList.add('is-open');
			document.body.classList.add('moxy-modal-open');
		}

		function closeModal(event) {
			if (event) {
				event.preventDefault();
			}

			modal.classList.remove('is-open');
			document.body.classList.remove('moxy-modal-open');
		}

		openers.forEach(function (opener) {
			opener.addEventListener('click', openModal);
		});

		closers.forEach(function (closer) {
			closer.addEventListener('click', closeModal);
		});

		modal.addEventListener('click', function (event) {
			if (event.target === modal) {
				closeModal();
			}
		});

		document.addEventListener('keydown', function (event) {
			if (event.key === 'Escape') {
				closeModal();
			}
		});
	}

	document.addEventListener('DOMContentLoaded', function () {
		setupSlider(
			document.querySelector('.js-moxy-slider'),
			'.js-moxy-prev',
			'.js-moxy-next',
			'.js-moxy-status',
			'.moxy-hero-slide'
		);

		setupSlider(
			document.querySelector('.js-moxy-carousel'),
			'.js-carousel-prev',
			'.js-carousel-next',
			'.js-carousel-status',
			'.moxy-carousel-slide'
		);

		setupTabs(document.querySelector('.js-moxy-tabs'));
		setupBookingModal();
	});
})();