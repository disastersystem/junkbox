Vue.component('progress-view', {
	data() {
		return {
			completed: 50
		};
	},

	methods: {
		addTen() {
			if (this.completed < 100) {
				this.completed += 10;
			}
		}
	}
});

new Vue({
	el: '#container'
});