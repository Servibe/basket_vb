<div class="aside">
	<h3 class="aside-title">Subcategorias</h3>
	<div>
		<div>
			<label>
				<a href="/ocultoBalones">
					<span></span>
					Balones
					<small>(<?php $tipo = \DB::table('productos')->where('tipo_producto', 2)->count(); echo $tipo; ?>)</small>
				</a>
			</label>
		</div>

		<div>
			<label>
				<a href="/ocultoBolsas">
					<span></span>
					Bolsas
					<small>(<?php $tipo = \DB::table('productos')->where('tipo_producto', 3)->count(); echo $tipo; ?>)</small>
				</a>
			</label>
		</div>

		<div>
			<label>
				<a href="/ocultoFundas">
					<span></span>
					Fundas
					<small>(<?php $tipo = \DB::table('productos')->where('tipo_producto', 9)->count(); echo $tipo; ?>)</small>
				</a>
			</label>
		</div>

		<div>
			<label>
				<a href="/ocultoGorras">
					<span></span>
					Gorras
					<small>(<?php $tipo = \DB::table('productos')->where('tipo_producto', 10)->count(); echo $tipo; ?>)</small>
				</a>
			</label>
		</div>

		<div>
			<label>
				<a href="/ocultoGorros">
					<span></span>
					Gorros
					<small>(<?php $tipo = \DB::table('productos')->where('tipo_producto', 11)->count(); echo $tipo; ?>)</small>
				</a>
			</label>
		</div>

		<div>
			<label>
				<a href="/ocultoJuegos">
					<span></span>
					Juegos
					<small>(<?php $tipo = \DB::table('productos')->where('tipo_producto', 12)->count(); echo $tipo; ?>)</small>
				</a>
			</label>
		</div>

		<div>
			<label>
				<a href="/ocultoPosters">
					<span></span>
					Posters
					<small>(<?php $tipo = \DB::table('productos')->where('tipo_producto', 14)->count(); echo $tipo; ?>)</small>
				</a>
			</label>
		</div>

		<div>
			<label>
				<a href="/ocultoTazas">
					<span></span>
					Tazas
					<small>(<?php $tipo = \DB::table('productos')->where('tipo_producto', 16)->count(); echo $tipo; ?>)</small>
				</a>
			</label>
		</div>
	</div>
</div>