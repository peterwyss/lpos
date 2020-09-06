export async function getNewInvoice(){
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
    
    console.log("Response: ",response);
    return [response.data.journalId] 
    } catch(e){
        console.log("error:" ,e);
        return e;
    }
}