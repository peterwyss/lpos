export async function getNewInvoice(){
  
		return axios.post("/invoice/store",
			{
        'status' : 0,
        'sum' :  0,
        'vat' : 0
      } 
		)
		.then(response => {
        console.log("getNewInvoice response:",response.data.invoiceId);
        let res = response.data.message;
        return  response.data.invoiceId;
  }).catch(e => {
    console.log("error:" ,e);
    console.log("++++++++++++");
    return -1;
  });
}

export async function updateInvoice(number, total){
   console.log("updateInvoice: ", number);
   return axios.post("/invoice/update",
			{
        'id' : number,
        'status' : 0,
        'sum' :  total
        
      } 
		)
		.then(response => {
        console.log("updateInvoice response:",response);
        return  response;
  }).catch(e => {
    console.log("error:" ,e);
    console.log("++++++++++++");
    return -1;
  });
}



export async function saveJournal(item,invoiceId){
    console.log("invoiceId saveJournal",invoiceId);
    try{
      const response = await axios(
      {
        url: "/journal/store",
        method: 'POST',
        //headers: {
        //	'Accept': 'application/json',
        //	'Content-Type': 'application/json',
        //	'X-CSRF-TOKEN': _TOKEN
        //},
        params: {
            'invoice' : invoiceId,
            'quantity' : item.quantity,
            'name' : item.name,
            'plu' : item.plu,
            'category': item.category,
            'price': item.price

        }
      });
    
    console.log("Response saveJournal: ",response);
    return [response.data.journalId] 
    } catch(e){
        console.log("error:" ,e);
        console.log(e);

        console.log("-----------");
        location.reload();
        
        return -1;
    }
}