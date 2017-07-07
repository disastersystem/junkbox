

	Vue.component('message', {
		props: ['title', 'body'],

		data() {
			return {
				isVisible: true
			};
		},

		template: `
			<article class="message is-info" v-show="isVisible">
				<div class="message-header">
					{{ title }}
					<button v-on:click="close">close</button>
				</div>
				<div class="message-body">{{ body }}</div>
			</article>
		`,

		methods: {
			close: function() {
				this.isVisible = false;
			}
		}
	});

	new Vue({
		el: '#container'
	});