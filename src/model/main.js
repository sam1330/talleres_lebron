export const baseUrl = "http://localhost/talleres_lebron/api/"; 

export const currencyFormatter = (val) => {
  var formatter = new Intl.NumberFormat("en-US", {
    style: "currency",
    currency: "USD",
    maximumFractionDigits: 0, // (causes 2500.99 to be printed as $2,501)
    //minimumFractionDigits: 0, // (this suffices for whole numbers, but will print 2500.10 as $2,500.1)
  });
  return formatter.format(val);
};

