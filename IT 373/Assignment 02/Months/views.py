from django.shortcuts import render


# Create your views here.
events_list = {
    "January": [
        "New Year's Day",
        "Chinese New Year",
    ],
    "February": [
        "Valentine's Day",
        "EDSA People Power Revolution Anniversary",
    ],
    "March": [
        "Fire Protection Month",
    ],
    "April": [
        "April Fool's Day",
        "Araw ng Kagitingan (Day of Valor)",
        "Easter Sunday",
    ],
    "May": [
        "Labor Day",
        "Flores de Mayo",
    ],
    "June": [
        "Independence Day",
        "Fathers' Day",
    ],
    "July": [
        "Nutrition Month",
    ],
    "August": [
        "Buwan ng Wika",
        "National Heroes Day",
    ],
    "September": [
        "National Peace Consciousness Month",
    ],
    "October": [
        "Halloween",
        "World Teacher's Day"
    ],
    "November": [
        "All Saints' Day",
        "All Souls' Day",
        "Bonifacio Day",
    ],
    "December": [
        "Christmas Day",
        "Rizal Day",
    ],
}

month_map = {
    1: "January",
    2: "February",
    3: "March",
    4: "April",
    5: "May",
    6: "June",
    7: "July",
    8: "August",
    9: "September",
    10: "October",
    11: "November",
    12: "December",
}


def home(request):
    context = {
        "months": events_list.keys(),
        "title": "Home",
    }

    return render(request, "home.html", context)



def months(request, month):
    events = get_events(month)

    context = {
        "events": events[1],
        "month": events[0].title(),
        "title": events[0].title(),
    }

    return render(request, "month.html", context)



def get_events(month):
    if isinstance(month, int):
        if month not in month_map:
            return "Invalid", []
        return month_map[month], events_list[month_map[month]]
    
    if month not in events_list:
        return "Invalid", []
    
    return month, events_list[month]