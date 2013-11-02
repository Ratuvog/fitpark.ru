$(function(){
    ymaps.ready(init);
})

var myPlacemark,
    selectedDistricts = [],
    allDistrictsSelect,
    allDistricts,
    collectionsClubs,
    loader,
    isStarted = true,
    contentLayoutClass,
    myMap;


function init()
{
    allDistricts = $("#sidebar-map-options a");
    allDistrictsSelect = allDistricts.get(0);
    loader = $(".loader");
    allDistricts.click(click);
    getClubs()
}

function addClubToMap(city, currentAddress, clubName, clubUrl)
{
    var clubGeoInfo = ymaps.geocode(city+", "+currentAddress);
    (function(city, currentAddress, clubName, clubHref){
        clubGeoInfo.then(function(res){
            var placemark = new ymaps.Placemark(
                res.geoObjects.get(0).geometry.getBounds()[0],
                {
                    address: currentAddress,
                    url: clubHref,
                    name: clubName,
                    balloonContent: clubName,
                    hintContent: clubName
                },
                {
                    balloonContentLayout: contentLayoutClass
                }
            )
            myMap.geoObjects.add(placemark);

        })
    })(city, currentAddress, clubName, clubUrl);
    return clubGeoInfo;
}

function addClubsToMap(city, clubs, collectionsClubs, myMap)
{
    var objects = [];
    for (i in clubs)
    {
        var currentAddress = clubs[i].address;
        var clubName = clubs[i].name;
        var clubHref = clubs[i].url;
        if(i != 0)
        {
            objects = objects.add(addClubToMap(city, currentAddress, clubName, clubHref));
        } else {
            objects = ymaps.geoQuery(addClubToMap(city, currentAddress, clubName, clubHref));
        }
    }
    if(Object.keys(clubs).length)
    {
        objects.then(function(){
            if(objects.getLength() > 1)
                myMap.setBounds(myMap.geoObjects.getBounds());
            else
            {
                myMap.setCenter(myMap.geoObjects.get(0).geometry.getCoordinates(), 16, {
                    checkZoomRange: true
                })
            }
            loader.hide();
        })
    } else {
        loader.hide();
    }


}

function getClubs(districtsList)
{
    loader.show();
    $.get("club_selector/getClubsByDistrict",{'districts' : districtsList},function(data){
        data = $.parseJSON(data)
        var city = data[0];
        var clubs = data[1]
        if(isStarted)
        {
            ymaps.geocode(city, { results: 1 }).then(function (res) {
                // Выбираем первый результат геокодирования.
                var firstGeoObject = res.geoObjects.get(0);
                // Создаем карту с нужным центром.
                myMap = new ymaps.Map("YMapsID", {
                    center: firstGeoObject.geometry.getCoordinates(),
                    zoom: 11,
                    controls: ["zoomControl"]
                });
                contentLayoutClass = ymaps.templateLayoutFactory.createClass($("#baloonTemplate").html());
                ymaps.layout.storage.add("myLayout", contentLayoutClass);
                myMap.container.fitToViewport();
                collectionsClubs = new  ymaps.GeoObjectCollection({},{
                    preset: 'twirl#redIcon' });
                myMap.geoObjects.add(collectionsClubs);
                addClubsToMap(city, clubs, collectionsClubs, myMap);
            })
            isStarted = false;
        } else {
            collectionsClubs = myMap.geoObjects.removeAll();
            addClubsToMap(city, clubs, collectionsClubs, myMap);
        }
    })
}

function click(e)
{

    var href = e.target.getAttribute('href');
    if(href == -1)
    {
        selectedDistricts = [];
        $("#sidebar-map-options a").removeClass('sidebar-map-menu-active');
        $(this).addClass('sidebar-map-menu-active');
    } else {
        var index = selectedDistricts.indexOf(href);

        if(index == -1)
        {
            selectedDistricts.push(href)
            $(this).addClass('sidebar-map-menu-active');
            $(allDistrictsSelect).removeClass('sidebar-map-menu-active');
        } else {
            selectedDistricts.splice(index, 1);
            $(this).removeClass('sidebar-map-menu-active');
        }
    }

    getClubs(selectedDistricts);
    return false;
}