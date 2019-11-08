<div class="aside">
	<h3 class="aside-title">Subcategorias</h3>
	<div>
		<div>
			<label>
				<a href="/wallpapers">
					<span></span>
					Todos
					<small>(<?php $tipo = \DB::table('productos')->where('tipo_producto', 17)->count(); echo $tipo; ?>)</small>
				</a>
			</label>
		</div>

		<div>
			<label>
				<a href="/ordenador">
					<span></span>
					Ordenador
					<small>(<?php $tipo = \DB::table('productos')->where('tipo_producto', 17)->where('nombre', 'like', '%computer%')->count(); echo $tipo; ?>)</small>
				</a>
			</label>
		</div>

		<div>
			<label>
				<a href="/movil">
					<span></span>
					Móvil
					<small>(<?php $tipo = \DB::table('productos')->where('tipo_producto', 17)->where('nombre', 'like', '%phone%')->count(); echo $tipo; ?>)</small>
				</a>
			</label>
		</div>
	</div>
</div>