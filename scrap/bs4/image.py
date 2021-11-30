import requests
from bs4 import BeautifulSoup
	
def getdata(url):
	r = requests.get(url)
	return r.text
	
htmldata = getdata("https://veeba.in/products/sriracha-chilli-garlic-sauce-320g")
soup = BeautifulSoup(htmldata, 'html.parser')
for item in soup.find_all('img'):
	print(item['src'])
