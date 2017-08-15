# Widgets ACF
![#](https://img.shields.io/badge/release-v1.0.0-blue.svg?style=flat-square)
![#](https://img.shields.io/badge/Front--end-50%25-brightgreen.svg?style=flat-square)
![#](https://img.shields.io/badge/Back--end-90%25-yellow.svg?style=flat-square)
![#](https://img.shields.io/badge/license-ISC-lightgrey.svg?style=flat-square)

---

### Como funciona?
---
Acf widgets foi desenvolvido para um projeto único em que transforma seu site modular utilizando o conceito de widgets,
pondendo controlar o conteúdo de forma dinamica com a ajuda do bootstrap nas seguintes actions do wordpress:
* **pages** >= seleciona página a página que possuirá widgets de conteudo.
* **post_types** >= podendo selecionar um ou mais post_type via painel. (post - padrão)
* **taxonomies** >= podendo selecionar a taxonomia via painel.


### Personalize um widget

Siga o tutorial a seguir para criar e personalizar seu widget:

1. Acesse a pasta do plugin em **wp-content/plugins/widgets-acf**
2. Copie a pasta **widgets-templates**
3. Cole a pasta **widgets-templates** dentro do seu tema ao lado da index.php **/wp-content/themes/tema**
4. Pronto, agora você ja pode editar e criar widgets para seu tema.

### Como criar campos para um widget
Como pode observar em um dos widgets, para definir os campos que serão utilizados basta utilizar os seguintes parametros que possuem o ACF: 
** coloque (__) para duplicar campos exemplo: ['text__1'], ['text__2']

### icone widget
$fields['icon'] = 'Class do font awesome (fa fa-cube)';
$fields['text__']['key'] = 'key_text_widget_novo'; *não é obrigatório

#### Campo de texto
$fields['text__']['label'] = 'Nome do campo';

#### Campo de select
$fields['select__']['label'] = 'Nome do campo';
$fields['select__']['choices'] = array(1 => 'opção 1', 2 => 'opção 2');

#### Campo de textarea
$fields['textarea__']['label'] = 'Nome do campo';

#### Campo de color_picker
$fields['color_picker__']['label'] = 'Nome do campo';

#### Campo de image
$fields['image__']['label'] = 'Nome do campo';


### Para trazer os valores dos campos criados basta trazer a variavel $fields no index.php do seu widget:

*index.php
<?php var_dump($fields); ?>
