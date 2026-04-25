(function () {
	function setupHeaderScroll(root) {
		if (!root) {
			return;
		}

		function updateState() {
			root.classList.toggle('is-scrolled', window.scrollY > 24);
		}

		updateState();
		window.addEventListener('scroll', updateState, { passive: true });
	}

	function setupTabs(root) {
		if (!root) {
			return;
		}

		var triggers = Array.prototype.slice.call(root.querySelectorAll('.cph-tab-trigger'));
		var panels = Array.prototype.slice.call(root.querySelectorAll('.cph-tab-panel'));

		if (!triggers.length || triggers.length !== panels.length) {
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

	function setupCarousel(root) {
		if (!root) {
			return;
		}

		var slides = Array.prototype.slice.call(root.querySelectorAll('.cph-carousel-slide'));
		var dots = Array.prototype.slice.call(root.querySelectorAll('.cph-carousel-dot'));
		var previous = root.querySelector('.js-carousel-prev');
		var next = root.querySelector('.js-carousel-next');
		var currentIndex = slides.findIndex(function (slide) {
			return slide.classList.contains('is-active');
		});
		var intervalId;

		if (!slides.length) {
			return;
		}

		if (currentIndex < 0) {
			currentIndex = 0;
		}

		function render() {
			slides.forEach(function (slide, index) {
				slide.classList.toggle('is-active', index === currentIndex);
			});

			dots.forEach(function (dot, index) {
				dot.classList.toggle('is-active', index === currentIndex);
			});
		}

		function goTo(index) {
			currentIndex = (index + slides.length) % slides.length;
			render();
		}

		function restartAutoPlay() {
			if (intervalId) {
				window.clearInterval(intervalId);
			}

			intervalId = window.setInterval(function () {
				goTo(currentIndex + 1);
			}, 6000);
		}

		if (previous) {
			previous.addEventListener('click', function (event) {
				event.preventDefault();
				goTo(currentIndex - 1);
				restartAutoPlay();
			});
		}

		if (next) {
			next.addEventListener('click', function (event) {
				event.preventDefault();
				goTo(currentIndex + 1);
				restartAutoPlay();
			});
		}

		dots.forEach(function (dot, index) {
			dot.addEventListener('click', function (event) {
				event.preventDefault();
				goTo(index);
				restartAutoPlay();
			});
		});

		render();
		restartAutoPlay();
	}

	function setupHeaderMobileCta() {
		var header = document.querySelector('.js-cph-header');
		if (!header) {
			return;
		}

		var originalCta = header.querySelector('.cph-header__cta');
		var nav = header.querySelector('.cph-header__nav');
		if (!originalCta || !nav) {
			return;
		}

		function maybeInjectCta() {
			var openContainer = nav.querySelector('.wp-block-navigation__responsive-container.is-menu-open');
			if (!openContainer) {
				return;
			}

			var dialog = openContainer.querySelector('.wp-block-navigation__responsive-dialog');
			if (!dialog || dialog.querySelector('.cph-header__cta--menu')) {
				return;
			}

			var clone = originalCta.cloneNode(true);
			clone.classList.remove('cph-header__cta');
			clone.classList.add('cph-header__cta--menu');
			dialog.appendChild(clone);
		}

		var observer = new MutationObserver(function () {
			maybeInjectCta();
		});

		observer.observe(nav, { childList: true, subtree: true });
		maybeInjectCta();
	}

	document.addEventListener('DOMContentLoaded', function () {
		setupHeaderScroll(document.querySelector('.js-cph-header'));
		setupHeaderMobileCta();
		setupTabs(document.querySelector('.js-cph-tabs'));
		setupCarousel(document.querySelector('.js-cph-carousel'));
	});
})();
