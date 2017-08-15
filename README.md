# Widgets ACF
![#](https://img.shields.io/badge/release-v1.0.0-blue.svg?style=flat-square)
![#](https://img.shields.io/badge/Front--end-50%25-brightgreen.svg?style=flat-square)
![#](https://img.shields.io/badge/Back--end-90%25-yellow.svg?style=flat-square)

---
## Como funciona?
---

ACF Widgets foi desenvolvido para criação de temas modulares de WordPress. Utilizando o conceito de "Widgets Drag and Drop", o plugin torna possível controlar o conteúdo de forma dinâmica (utilizando as grids do bootstrap) nas seguintes visualizações do WordPress:

* **pages** >= Podendo selecionar a página que possuirá widgets de conteudo.
* **post_types** >= Podendo selecionar um ou mais post_type via painel. (post - padrão)
* **taxonomies** >= Podendo selecionar a taxonomia via painel.


## Personalize seu próprio widget

Siga o tutorial a seguir para criar e personalizar um widget:

1. Acesse a pasta do plugin em **wp-content/plugins/widgets-acf**
2. Copie a pasta **widgets-templates**
3. Cole a pasta **widgets-templates** na raiz de seu tema ao lado da **/wp-content/themes/seu-tema -> index.php**
4. Pronto, agora você ja pode editar e criar widgets para seu tema dentro do diretório <br> **themes/seu-tema/widgets-templates** no seu tema.

## Como criar campos no wp-admin para um widget
Como pode observar em um dos widgets do plugin no arquivo **functions.php**, para definir os campos que serão criados, basta criar os seguintes parâmetros na variável ** $fields ** como na documentação do ACF:


### Key field - (não é obrigatório)
* $fields['text__']['key'] = 'key_text_widget_novo';
* $fields['text__2']['key'] = 'key_text_widget_novo_2'; 



### Campo de texto - ['text']
* $fields['text__']['label'] = 'Nome do campo';



### Campo de Seleção - ['select']
* $fields['select__']['label'] = 'Nome do campo';
* $fields['select__']['choices'] = array(1 => 'opção 1', 2 => 'opção 2');



### Campo de textarea - ['textarea']
* $fields['textarea__']['label'] = 'Nome do campo';



### Campo de color_picker - ['color_picker']
* $fields['color_picker__']['label'] = 'Nome do campo';



### Campo de image - ['image']
* $fields['image__']['label'] = 'Nome do campo';


Quando for necessário criar mais de um campo do mesmo tipo, apenas adicione "__" (2x underline) ,seguido de uma string identificadora, a frente do tipo do campo, como no exemplo que segue:
**['text__1'], ['text__2']**


## Opções do widget

### icone widget
* $fields['icon'] = 'Class do font awesome (fa fa-cube)';


### Trazer os valores dos campos criados em $fields:

* /widgets-templates/widget_new/**index.php -> var_dump($fields);**
