/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
(function () {
		function Slideshow(element) {
			this.el = document.querySelector(element);
			this.init();
		}
		Slideshow.prototype = {
			init: function () {
				this.wrapper = this.el.querySelector(".pg-cards-wrapper");
				this.slides = this.el.querySelectorAll(".pg-card-slide");
				this.previous = this.el.querySelector(".pg-card-slide-previous");
				this.next = this.el.querySelector(".pg-card-slide--next");
				this.index = 0;
				this.total = this.slides.length;
				this.timer = null;
				this.action();
				this.stopStart();
			}
			, _slideTo: function (slide) {
				var currentSlide = this.slides[slide];
				currentSlide.style.opacity = 1;
				for (var i = 0; i < this.slides.length; i++) {
					var slide = this.slides[i];
					if (slide !== currentSlide) {
						slide.style.opacity = 0;
					}
				}
			}
			, action: function () {
				var self = this;
				self.timer = setInterval(function () {
					self.index++;
					if (self.index == self.slides.length) {
						self.index = 0;
					}
					self._slideTo(self.index);
				}, 5000);
			}
			, stopStart: function () {
				var self = this;
				self.el.addEventListener("mouseover", function () {
					clearInterval(self.timer);
					self.timer = null;
				}, false);
				self.el.addEventListener("mouseout", function () {
					self.action();
				}, false);
			}
		};
		document.addEventListener("DOMContentLoaded", function () {
			var slider = new Slideshow("#pg-cards-slider");
		});
	})();

