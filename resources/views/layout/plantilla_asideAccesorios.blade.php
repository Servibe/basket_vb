<div class="aside">
	<h3 class="aside-title">SubCategorias</h3>
	<div>
		<div>
			<label>
				<a href="/ocultoAnillos">
					<span></span>
					Anillos
					<small>(<?php $tipo = \DB::table('productos')->where('tipo_producto', 1)->count(); echo $tipo; ?>)</small>
				</a>
			</label>
		</div>

		<div>
			<label>
				<a href="/ocultoCalcetines">
					<span></span>
					Calcetines
					<small>(<?php $tipo = \DB::table('productos')->where('tipo_producto', 4)->count(); echo $tipo; ?>)</small>
				</a>
			</label>
		</div>

		<div>
			<label>
				<a href="/ocultoCintas">
					<span></span>
					Cintas
					<small>(<?php $tipo = \DB::table('productos')->where('tipo_producto', 8)->count(); echo $tipo; ?>)</small>
				</a>
			</label>
		</div>

		<div>
			<label>
				<a href="/ocultoCalentadores">
					<span></span>
					Calentadores
					<small>(<?php $tipo = \DB::table('productos')->where('tipo_producto', 5)->count(); echo $tipo; ?>)</small>
				</a>
			</label>
		</div>
	</div>
</div>