
	Vue.component('modal', {
		template: `
			<div class="modal is-active">
				<div class="modal-background"></div>
				<div class="modal-card">
					<header class="modal-card-head" style="border-radius: 0;">
						<!-- modal-card-title -->
						<p class=""><strong>Påmelding til Greve Ala Chanti drømmetur</strong></p>
						<!-- <button class="delete" v-on:click="$emit('close')"></button> -->
						<button class="delete modal-close" v-on:click="$emit('close')"></button>
					</header>
					<section class="modal-card-body">
						<!-- <div class="box"> -->
							<slot></slot>
						<!-- </div> -->
						<div style="margin: 50px 0; text-align: center;">
							<a class="button is-primary" style="padding: 20px;">Send påmelding</a>
							<!-- <a class="button" v-on:click="$emit('close')">Cancel</a> -->
						</div>
					</section>
					<!-- <footer class="modal-card-foot">
						
					</footer> -->
				</div>
			</div>
		`,
	});



	new Vue({
		el: '#container',

		data: {
			showModal: false
		}
	});