<div class="aside">
	<h3 class="aside-title">Subcategorias</h3>
	<div>
		<div>
			<label>
				<a href="/ocultoCamisetas">
					<span></span>
					Camisetas
					<small>(<?php $tipo = \DB::table('productos')->where('tipo_producto', 6)->count(); echo $tipo; ?>)</small>
				</a>
			</label>
		</div>

		<div>
			<label>
				<a href="/ocultoMangas">
					<span></span>
					T-Shirt
					<small>(<?php $tipo = \DB::table('productos')->where('tipo_producto', 7)->count(); echo $tipo; ?>)</small>
				</a>
			</label>
		</div>

		<div>
			<label>
				<a href="/ocultoPantalones">
					<span></span>
					Pantalones
					<small>(<?php $tipo = \DB::table('productos')->where('tipo_producto', 13)->count(); echo $tipo; ?>)</small>
				</a>
			</label>
		</div>

		<div>
			<label>
				<a href="/ocultoSudaderas">
					<span></span>
					Sudaderas
					<small>(<?php $tipo = \DB::table('productos')->where('tipo_producto', 15)->count(); echo $tipo; ?>)</small>
				</a>
			</label>
		</div>
	</div>
</div>