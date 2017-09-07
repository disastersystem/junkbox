function timeStringToObject(timestamp)
{
	var Time = function (year, month, day, hour, min )
	{
		this.year  = year;
		this.month = month;
		this.day   = day;
		this.hour  = hour;
		this.min   = min;
	}
	
	var cTime = new Time 
	(
		parseInt(timestamp.slice(0,4)),
		parseInt(timestamp.slice(5,7)),
		parseInt(timestamp.slice(8,10)),
		parseInt(timestamp.slice(11,13)),
		parseInt(timestamp.slice(14,16))
	);
	
	return cTime;
}

function convertTimeToText(time)
{
	var comTime = timeStringToObject(time);
	var curTime = new Date();
	
	var yearDiff  = curTime.getFullYear() - comTime.year;
	var monthDiff = (curTime.getMonth() +1) - comTime.month;
	var dayDiff   = curTime.getDate() - comTime.day;
	var hourDiff  = curTime.getHours() - comTime.hour;
	var minDiff   = curTime.getMinutes() - comTime.min;
	
	var timeString;
	
	if(yearDiff == 0 && monthDiff != 0 )
	{
		if(monthDiff <= 12)
			timeString = monthDiff + " month(s) ago";
	}
	
	else if(yearDiff == 0 && monthDiff == 0 && dayDiff != 0 )
	{	
		if(dayDiff == 1)
			timeString = "Yesterday";
		
		else if(dayDiff > 1 && dayDiff < 7)
			timeString = dayDiff + " days ago";
		
		else if(dayDiff >= 7)
			timeString = dayDiff % 7 + " week(s) ago";
	}
	
	else if(dayDiff == 0 && hourDiff != 0)
	{
		
		if(hourDiff < 23 && minDiff < 59)
		{
			if(hourDiff == 1)
				timeString = "1 hour ago";
			else
				timeString = hourDiff + " hours ago";
		}
		else
			timeString = "Today";
	}
	
	else if(hourDiff == 0 && minDiff != 0)
	{
		if(minDiff == 1)
			timeString = "1 minute ago";
		else
			timeString = minDiff + " minutes ago";
	}
	else
		timeString = "Just now";
	
	return timeString;
	
}









