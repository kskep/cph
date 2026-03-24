(function () {
	function setupTabs(root) {
		if (!root) {
			return;
		}

		var triggers = Array.prototype.slice.call(root.querySelectorAll('.moxy-tab-trigger'));
		var panels = Array.prototype.slice.call(root.querySelectorAll('.moxy-tab-panel'));

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

		var slides = Array.prototype.slice.call(root.querySelectorAll('.moxy-carousel-slide'));
		var dots = Array.prototype.slice.call(root.querySelectorAll('.moxy-carousel-dot'));
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

	document.addEventListener('DOMContentLoaded', function () {
		setupTabs(document.querySelector('.js-moxy-tabs'));
		setupCarousel(document.querySelector('.js-moxy-carousel'));
	});
})();