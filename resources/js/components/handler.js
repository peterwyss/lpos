export async function getNewInvoice(){
  console.log("function")
  try{
		const response = await axios(
		{
			url: "/invoice/store",
			method: 'POST',
			//headers: {
			//	'Accept': 'application/json',
			//	'Content-Type': 'application/json',
			//	'X-CSRF-TOKEN': _TOKEN
			//},
			params: {
                'status' : 0,
				'sum' :  0

			}
		});
		console.log("Response: ",response);
        let res = response.data.message;
        return  response.data.invoiceId;
  }catch(e){
    console.log("error:" ,e);
    console.log("++++++++++++");
    return -1;
  }
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
        console.log("-----------");
        return -1;
    }
}