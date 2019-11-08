<div class="aside">
	<h3 class="aside-title">Subcategorias</h3>
	<div>
		<div>
			<label>
				<a href="/ocultoNike">
					<span></span>
					Nike
					<small>(<?php $tipo = \DB::table('productos')->where('proveedor', '=', 'Nike')->where('tipo_producto', 18)->count(); echo $tipo; ?>)</small>
				</a>
			</label>
		</div>

		<div>
			<label>
				<a href="/ocultoAdidas">
					<span></span>
					Adidas
					<small>(<?php $tipo = \DB::table('productos')->where('proveedor', '=', 'Adidas')->where('tipo_producto', 18)->count(); echo $tipo; ?>)</small>
				</a>
			</label>
		</div>

		<div>
			<label>
				<a href="/ocultoJordan">
					<span></span>
					Jordan
					<small>(<?php $tipo = \DB::table('productos')->where('proveedor', '=', 'Jordan')->where('tipo_producto', 18)->count(); echo $tipo; ?>)</small>
				</a>
			</label>
		</div>

		<div>
			<label>
				<a href="/ocultoUnder">
					<span></span>
					Under Armour
					<small>(<?php $tipo = \DB::table('productos')->where('proveedor', '=', 'Under Armour')->where('tipo_producto', 18)->count(); echo $tipo; ?>)</small>
				</a>
			</label>
		</div>
	</div>
</div>