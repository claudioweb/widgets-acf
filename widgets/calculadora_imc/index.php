<?php $content = calculadora_imc::content($fields); ?>
<div class="column is-4 <?php echo $show_mobile; ?>" data-script="Calculator">
	<div id="cardCalculator" class="card">
		<div class="card-header">
			<div class="columns">
				<div class="column is-2">
					<div class="meter-icon">
						<?php include(plugin_dir_path( __FILE__ ).'img/meter.svg'); ?>
					</div>
				</div>
				<div class="column">
					<p class="card-title card-title-primary" data-visible="true">
						<strong>Seu peso ideal</strong> <br>
						Alcance o peso dos seus sonhos
					</p>

					<p class="card-title card-title-secondary" data-visible="false">
						<strong>Receba sua avaliação por e-mail</strong> <br>
						Preencha os dados abaixo
					</p>
				</div>
			</div>
		</div>
		<div class="card-body">
			<form method="POST" action="<?php echo get_permalink($content->ID); ?>" class="calculator" id="widgetCalculator" onsubmit="return false">

				<div class="field-group imc-params" data-visible="true">
					<input type="hidden" name="nome_origem" value="<?php echo $content->nome_origem; ?>">
					<input type="hidden" name="id_origem" value="<?php echo $content->id_origem; ?>">
					<div class="field">
						<label class="weight">Peso</label>
						<p class="control has-icons-right">
							<input type="text" class="input" id="weight" name="weight" placeholder="Digite o seu peso" data-error="false">
							<span class="icon is-right">
								KG
							</span>
						</p>
					</div>

					<div class="field">
						<label class="height">Altura</label>
						<p class="control has-icons-right">
							<input type="text" class="input" id="height" name="height" placeholder="Digite a sua altura" data-error="false">
							<span class="icon is-right">
								CM
							</span>
						</p>
					</div>

					<button type="button" class="button button-large button-block button-green button-shadow" id="nextForm">Alcançar peso ideal</button>
				</div>

				<div class="field-group newsletter-params" data-visible="false">
					<div class="field">
						<label class="name">Nome</label>
						<input type="text" class="input" id="name" name="nome" placeholder="Digite o seu nome" data-error="false">
					</div>

					<div class="field newsletter-field-secondary">
						<label class="email">E-mail</label>
						<input type="email" class="input" id="email" name="email" placeholder="Digite o seu e-mail" data-error="false">
					</div>

					<button type="submit" id="submit-calculator" class="button button-large button-block button-green button-shadow">Alcançar peso ideal</button>
					<button type="button" class="button button-large button-block button-green button-skeleton button-shadow" id="prevForm">Voltar</button>
				</div>

				<input type="hidden" value="" name="result" id="result">
			</form>
		</div>
	</div>
</div>