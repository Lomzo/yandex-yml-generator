<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
include('../ymlOffer.php');
include("../ymlDocument.php");

  //параметры: Короткое название магазина, полное наименование компании, [кодировка, по умолчанию utf-8]
  $y 	= new ymlDocument('Магаз','ООО Шикарный магаз интернейшнл'/* , 'windows-1251'*/);


  $y ->url('http://best.seller.ru'); 		// !!!	условно обязательный. Адрес магазина


 $y ->cms('Joomla!','3.4')					// 		CMS: название, [версия] они же 'platform' и 'version'
	 ->agency('Webdivision.ru')				//   	Агенство, отвечающее за работоспособность сайта
	 ->email('notdest@gmail.com');			//  	Контактный адрес разработчиков CMS или агентства

  $y ->currency('RUR',1)					// !!!	Минимум одна. 	Добавляем валюты, это основная, тк rate=1
	 ->currency('USD','CBRF',3)				// 		считаем по курсу ЦБ РФ, плюс 3 %
	 ->currency('EUR',70.8)					// 		дробную часть отделяем точкой

	 ->category(1,'Книги')					// !!!  должны быть.	категория, находится в корне, id - положительное целое число, больше 0
	 ->category(2,'Детективы',1)			// 		подкатегория в "книги"
	 ->category(3,'Боевики',1)
	 ->category(4,'Видео')
	 ->category(5,'Комедии',4);

  $y ->delivery(300,4,18) 					// !!! Условно обязательно. Доставка: стоимость 300р, срок 4 дня , до 18:00 срок не изменится
  	 ->delivery(500,0,15)
  	 ->delivery(0,'7-8')

  	 ->cpa();								//   	включение программы "Заказ на Маркете", можно еще передать false



//-------------- добавляем одну аудиокнигу

				//  name, publisher, price, currencyId, categoryId, [price from - "цена от ххх руб." ]
$offer = $y->audiobook('Все не так.', 'Эксмо', 'id01id1111', 900, "USD",15 /* , true*/ );


	$offer 	->isbn('978-5-94878-004-7')							// !!!	условно обязательный. ISBN, можно несколько через запятую
			->author("Александра Маринина")						//		Автор
			->series('А. Маринина — королева детектива') 		//		Серия
			->year(2007)										//		Год издания
			->volume(2)											//		Количество томов
			->part(1)											//		Номер тома
			->language('rus')									//		Язык произведения
			->contents('глава1 глава2 глава3')					//		Оглавление. table_of_contents, Яндекс примеров не предоставил

			->performer('Николай Фоменко')						//		performed_by Исполнитель, через запятую если несколько
			->performance('радиоспектакль')						//		performance_type Тип аудиокниги (радиоспектакль, произведение начитано, ...).
			->storage('CD')										//		Носитель, на котором поставляется аудиокнига.
			->format('mp3')										//		Формат аудиокниги.
			->length('45.30')									//		recording_length Время звучания, задается в формате mm.ss 

			->cbid(80)											//		Размер ставки на карточке товара. 0,8 у.е.
			->bid(90)											//		Размер ставки на остальных местах размещения. 0,9 у.е.
			->fee(220)											//		Размер комиссии от цены товара. 2.2%
			->available(false)									//		под заказ 

			->url("http://magaz.ru/tovar.html")					// !!!	условно обязательный. URL страницы товара 

			->oldprice(1500)									//   	Старая цена для расчёта скидки
			//->vat('VAT_10_110')			отсутствует в схеме	//		Ставка НДС для товара.

			->pic('http://best.seller.ru/img/book12345.jpg')	// !!!  условно обязательные. Картинки
			->pic('http://best.seller.ru/img/book124.jpg')
			->pic('http://best.seller.ru/img/book45.jpg')

			->delivery(/* false*/ )								//		Возможно доставить. false, чтобы невозможно

			->dlvOption(300,4,18)								//		Доставка: стоимость 300р, срок 4 дня , до 18:00 срок не изменится
			->dlvOption(0,'7-8')								//		бесплатно довезем через неделю. Вообще не больше 5 опций

			->pickup()											//  	Возможен самовывоз
			->store()											//   	можно купить в розничном магазине


			->description(										//		Описание с разрешенными тегами
'Все прекрасно в большом патриархальном семействе Руденко...<br/>
<p>ну и теги можно ставить здесь</p>'
 ,true)			
			// ->description('Просто описание')					//		или просто описание

			->sale('Необходима предоплата.')					//	!!!	sales_notes, минимальные суммы и партии, наличие скидок и т.д.	
			//->minq(2)						отсутствует в схеме	//	~	только в некоторых категориях. min-quantity ,минимальный заказ 2шт.
			//->stepq(2)					отсутствует в схеме	//	~	только в некоторых категориях. step-quantity , заказывыем по 2шт.


			->warranty()										//		manufacturer_warranty Официальная гарантия производителя.
			->origin('Демократическая Республика Конго')		//   	country_of_origin. страна производитель из списка Яндекса. Иногда желательно указывать
			->adult()											//		является товаром "для взрослых"
			->barcode(11122299)									//		штрихкод указанный производителем
			->cpa(false)										//		нельзя сделать "Заказ на Маркете"

			->param('Заснул через','30','мин')					//	!!!	Параметры из поиска на маркете
			->param('Голос','хриплый')							//		в каких-то категориях обязателен

			->expiry('P1Y2M10DT2H30M')							//		Срок годности ISO8601, может иметь формат YYYY-MM-DDThh:mm
			->weight(15.1)										//		Вес товара в килограммах с учетом упаковки.
			->dimensions(14.0,80.2,90.0)						//		длина, ширина и высота в сантиметрах
			->downloadable()									//		товар можно скачать
			->age(5,'month')									//		возрастная категория, годы или месяцы
			//->age(16,'year')
;



if ( !$y->schemaValidate('./shops_with_byn.xsd')) die(); 	// схема из тех. требований Яндекса


header('Content-Type: text/xml; charset=utf-8');
echo $y->saveXML();



?>