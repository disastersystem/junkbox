window.VueEvents = new Vue();

Vue.component('coupon', {
	template: '<input @blur="onCouponApplied">',

	methods: {
		onCouponApplied: function() {
			VueEvents.$emit('applied');
		}
	}
});

new Vue({
	el: '#container',

	data: {
		couponApplied: false
	},

	created() {
		VueEvents.$on('applied', () => this.couponApplied = true );
	},

	methods: {
		onCouponApplied: function() {
			
		}
	}
});