# Widgets ACF
![#](https://img.shields.io/badge/release-v1.0.0-blue.svg?style=flat-square)
![#](https://img.shields.io/badge/Front--end-50%25-brightgreen.svg?style=flat-square)
![#](https://img.shields.io/badge/Back--end-90%25-yellow.svg?style=flat-square)

---
## Como funciona?
---

Acf widgets foi desenvolvido para um projeto em que transforma seu tema em um projeto totalmente modular, utilizando o conceito de widgets drag in drop, pondendo controlar o conteúdo de forma dinamica com a ajuda das grids do bootstrap nas seguintes visualizações do wordpress:

* **pages** >= seleciona página a página que possuirá widgets de conteudo.
* **post_types** >= podendo selecionar um ou mais post_type via painel. (post - padrão)
* **taxonomies** >= podendo selecionar a taxonomia via painel.


## Personalize seu próprio widget

Siga o tutorial a seguir para criar e personalizar um widget:

1. Acesse a pasta do plugin em **wp-content/plugins/widgets-acf**
2. Copie a pasta **widgets-templates**
3. Cole a pasta **widgets-templates** dentro do seu tema ao lado da **/wp-content/themes/tema -> index.php**
4. Pronto, agora você ja pode editar e criar widgets para seu tema dentro do diretório <br> **themes/seu-tema/widgets-templates** no seu tema.

## Como criar campos no wp-admin para um widget
Como pode observar em um dos widgets do plugin no arquivo **functions.php**, para definir os campos que serão criados, basta criar os seguintes parametros na variavel ** $fields ** como na documentação do ACF:


### Key field - (não é obrigatório)
* $fields['text__1']['key'] = 'key_text_widget_novo';
* $fields['text__2']['key'] = 'key_text_widget_novo_2'; 



### Campo de texto - ['text']
* $fields['text__']['label'] = 'Nome do campo';



### Campo de Seleção - ['select']
* $fields['select__']['label'] = 'Nome do campo';
* $fields['select__']['choices'] = array(1 => 'opção 1', 2 => 'opção 2');
* $fields['select__']['multiple'] = 1; // para multipla seleção



### Campo de textarea - ['textarea']
* $fields['textarea__']['label'] = 'Nome do campo';



### Campo de color_picker - ['color_picker']
* $fields['color_picker__']['label'] = 'Nome do campo';



### Campo de image - ['image']
* $fields['image__']['label'] = 'Nome do campo';



### Campo de Repetição - ['repeater']
* $fields['repeater__']['label'] = 'Nome do campo';
* $fields['repeater__']['sub_fields']['text__']['label'] = 'Campo texto de repetição';
* $fields['repeater__']['sub_fields']['imagem__']['label'] = 'Campo imagem de repetição';

### Campo de Repetição 2x - ['repeater']
$fields['repeater__']['sub_fields']['repeater__']['sub_fields']['text__']['label'] = 'Título repetidor 2x';



### Duplicar campos (sem conflito)
Quando precisar criar mais de um campo do mesmo tipo, apenas adicione "__" a frente seguido de uma string identificadora
* (__) 2x underline para duplicar campos exemplo: **['text__1'], ['text__2']**


## Opções do widget

### icone widget
* $fields['icon'] = 'Class do font awesome (fa fa-cube)';


### Trazer os valores dos campos criados em $fields:

* /widgets-templates/widget_new/**index.php -> var_dump($fields);**
