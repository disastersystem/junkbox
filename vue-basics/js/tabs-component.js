new Vue({
	el: '#container'
});


Vue.component('tabs', {
	template: `
		<div>
			<div class="tabs is-centered">
				<ul>
					<li v-for="tab in tabs" :class="{ 'is-active' : tab.isActive }">
						<a :href="tab.href" @click="selectedTab(tab)">{{ tab.name }}</a>
					</li>
				</ul>
			</div>

			<div class="tab-content">
				<slot></slot>
			</div>
		</div>
	`,

	data() {
		return {
			tabs: []
		};
	},

	methods: {
		selectedTab(selectedTab) {
			this.tabs.forEach(tab => {
				tab.isActive = (tab.name == selectedTab.name);
			});
		}
	},

	created: function() {
		this.tabs = this.$children;
	}
});


Vue.component('tab', {
	props: {
		name: { required: true },
		selected: { default: false }
	},

	data() {
		return {
			isActive: false
		};
	},

	computed: {
		href() {
			return '#' + this.name.toLowerCase().replace(/ /g, '-');
		}
	},

	mounted() {
		this.isActive = this.selected;
	},

	template: '<div v-if="isActive"><slot></slot></div>'
});